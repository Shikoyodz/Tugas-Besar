<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Filament\Forms\Form;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\TextInput;
use Phpsa\FilamentPasswordReveal\Password;
use Filament\Forms\Concerns\InteractsWithForms;

class Signup extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public function mount() : void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
                ->schema([
                    TextInput::make('name')
                        ->label('Full Name')
                        ->placeholder('Enter your full name')
                        ->required(),
                    TextInput::make('email')
                        ->label('Email')
                        ->placeholder('Enter your email')
                        ->unique('users','email')
                        ->email()
                        ->required(),
                    Password::make('password')
                        ->label('Password')
                        ->same('passwordConfirmation')
                        ->password()
                        ->required(),
                    Password::make('passwordConfirmation')
                        ->label('Password Confirmation')
                        ->same('password')
                        ->password()
                        ->dehydrated(false)
                        ->required()

                ])
                ->statePath('data');
    }

    public function submit()
    {
        $this->form->validate();
        
        try{
            DB::beginTransaction();
            $data = $this->form->getState();

            $data['password'] = Hash::make(data_get($data,'password'));

            $user = User::create($data);

            DB::commit();

            Auth::login($user);

            return redirect()->to(route('home'));
        }catch(\Exception $e){
            DB::rollBack();
        }
    }

    public function render()
    {
        return view('livewire.signup')->layout('layouts.app');
    }
}
