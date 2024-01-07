<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Filament\Forms\Form;
use Illuminate\Support\Facades\DB;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class Profile extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public function mount() : void
    {
        $user = auth()->user();

        $this->form->fill([
            'name' => $user->name,
            'phone' => $user->phone,
            'email' => $user->email,
            'birth' => $user->birth,
            'location' => $user->location,
            // 'profile_picture' => $user->profile_picture
        ]);
    }

    public function form(Form $form): Form
    {
        return $form->schema([
                // FileUpload::make('profile_picture')
                //     ->disableLabel()
                //     ->image()
                //     ->multiple(false)
                //     ->disk('public')
                //     ->inlineLabel()
                //     ->extraAttributes(['class' => 'justify-end'])
                //     ->avatar(),
                TextInput::make('name')
                    ->label('Name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->unique('users','email',fn($state) => auth()->user()->email == $state)
                    ->required(),
                TextInput::make('phone')
                    ->label('Phone Number')
                    ->numeric(),
                DatePicker::make('birth')
                    ->label('Birth Date'),
                TextInput::make('location')
                    ->label('Location')
            ])
            ->statePath('data');
    }

    public function submit()
    {
        try{
            DB::beginTransaction();
            $data = $this->form->getState();

            auth()->user()->update($data);
            DB::commit();
        }catch(\Exception $e){
            DB::rollBack();
            dd($e);
        }
    }

    public function render()
    {
        return view('livewire.profile')->layout('layouts.app');
    }
}
