<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\Room;
use Livewire\Component;
use App\Models\RoomType;
use Filament\Forms\Form;
use App\Models\Accomodation;
use App\Enums\RoomStatusEnum;
use App\Models\PaymentMethod;
use App\Enums\BookingStatusEnum;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use App\Models\Booking as BookingModel;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Collection;
use Filament\Forms\Concerns\InteractsWithForms;
use Awcodes\FilamentTableRepeater\Components\TableRepeater;

class Booking extends Component implements HasForms
{
    use InteractsWithForms;

    public RoomType $roomType;

    public Room $room;

    public ?Collection $paymentMethods;

    public ?array $data = [];

    public ?array $accomodations = [];

    public ?array $billings = [];

    public ?array $accomodation_data = null;

    public string $from;

    public string $to;

    public float $tax;

    public float $room_total;

    public float $accomodation_total;

    public int $night;

    public float $total;

    public function mount(RoomType $roomType, Room $room)
    {
        try{
            if($room->status != RoomStatusEnum::Ready->value)
            {
                throw new \Exception('Room Is Not Ready!');
            }
    
            $this->from = now()->format('d M Y');
            $this->to = now()->addDay(1)->format('d M Y');

            $this->paymentMethods = PaymentMethod::get();

            $this->roomType = $roomType;
            $this->room = $room;

            $this->calculate();

            $this->form->fill();
            $this->createAccomodationForm->fill();
            $this->createBillingDetailForm->fill();
        }catch(\Exception $e)
        {
            abort(404);
        }
    }

    protected function getForms(): array
    {
        return [
            'form',
            'createAccomodationForm',
            'createBillingDetailForm'
        ];
    }

    public function change()
    {
        $this->form->validate();

        try{
            $data = $this->form->getState();
            $this->to = Carbon::createFromFormat('Y-m-d',data_get($data,'to'))->format('d M Y');

            $this->calculate();
            $this->dispatch('calender');
        }catch(\Exception $e){
            Notification::make()
                ->danger()
                ->title('Failed Change Date')
                ->send();
        }
    }

    public function addAccomodation()
    {
        $this->createAccomodationForm->validate();

        try{
            $data = $this->createAccomodationForm->getState();
            $this->accomodation_data = null;
            foreach($data['accomodations'] as $accomodation_data)
            {
                $accomodation = Accomodation::find($accomodation_data['accomodation_id']);
                $accomodation_data['name'] = $accomodation->name;
                $accomodation_data['total'] = $accomodation->price * $accomodation_data['qty'];
                $this->accomodation_data[] = $accomodation_data;
            }

            $this->createAccomodationForm->fill($data);
            $this->calculate();
            $this->dispatch('accomodation');
        }catch(\Exception $e){
            Notification::make()
                ->title('Failed To Add Accomodation')
                ->danger()
                ->send();
        }
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            DatePicker::make('to')
                ->label('To')
                ->minDate(now()->addDay()->startOfDay())
                ->required()
        ])->statePath('data');
    }

    public function createAccomodationForm(Form $form): Form
    {
        return $form->schema([
            TableRepeater::make('accomodations')
                ->disableLabel()
                ->collapsible()
                ->disableItemMovement()
                ->createItemButtonLabel('Add More')
                ->schema([
                    Select::make('accomodation_id')
                        ->label('Accomodation')
                        ->disableLabel()
                        ->options(Accomodation::pluck('name','id'))
                        ->required(),
                    TextInput::make('qty')
                        ->label('Quantity')
                        ->disableLabel()
                        ->minValue(1)
                        ->required()
                ])
        ])->statePath('accomodations');
    }

    public function createBillingDetailForm(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name')
                ->label('Full Name')
                ->inlineLabel()
                ->required(),
            TextInput::make('phone')
                ->label('Phone')
                ->inlineLabel()
                ->mask('(99) 999999999999')
                ->required(),
            TextInput::make('email')
                ->label('Email')
                ->inlineLabel()
                ->email()
                ->required(),
            TextInput::make('card_number')
                ->label('Card Number')
                ->inlineLabel()
                ->numeric()
                ->required(),
            TextInput::make('vcc')
                ->label('VCC')
                ->inlineLabel()
                ->numeric()
                ->required()
        ])->statePath('billings');
    }

    public function openValidationModal()
    {
        $this->createBillingDetailForm->validate();
        try{
            $data = $this->createBillingDetailForm->getState();

            $this->createBillingDetailForm->fill($data);
            $this->calculate();
            $this->dispatch('payment');
        }catch(\Exception $e)
        {
            Notification::make()
                ->title('Failed Make a Billing Details')
                ->danger()
                ->send();
        }
    }

    public function submit()
    {
        try{
            $this->calculate();
            $billings = $this->billings;
            $billings['phone'] = str_replace(['(',')',' '],'', $billings['phone']);

            $booking = BookingModel::create([
                'user_id' => auth()->user()->id,
                'room_type_id' => $this->roomType->id,
                'room_id' => $this->room->id,
                'room_type' => $this->roomType->name,
                'room_name' => $this->room->name,
                'status' => BookingStatusEnum::Active->value,
                'check_in' => Carbon::createFromFormat('d M Y',$this->from),
                'check_out' => Carbon::createFromFormat('d M Y',$this->to),
            ]);

            $booking->billingDetail()->create([
                'name' => data_get($billings,'name'),
                'phone' => data_get($billings,'phone'),
                'email' => data_get($billings,'email'),
                'card_number' => data_get($billings,'card_number'),
                'vcc' => data_get($billings,'vcc'),
                'qty' => $this->qty,
                'total' => $this->total,
                'price' => $this->roomType->price,
                'tax' => $this->tax,
                'accomodation_total' => $this->accomodation_total
            ]);

            $this->dispatch('validate');

            return redirect()->to(route('booking-detail'));
        }catch(\Exception $e)
        {
            Notification::make()
                ->danger()
                ->title('Failed To Make A Booking!')
                ->send();
        }
    }

    public function calculate()
    {
        $from = Carbon::createFromFormat('d M Y',$this->from)->startOfDay();
        $to = Carbon::createFromFormat('d M Y',$this->to)->startOfDay();

        $price = $this->roomType->price;
        $this->qty = $from->diffInDays($to);

        $this->room_total = $price * $this->qty;
        $this->accomodation_total = collect($this->accomodation_data)->sum('total');
        $this->tax = ($this->room_total + $this->accomodation_total) / 10;
        $this->total = $this->room_total + $this->accomodation_total + $this->tax;
    }

    public function render()
    {
        return view('livewire.booking')->layout('layouts.app');
    }
}
