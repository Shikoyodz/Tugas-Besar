<?php

namespace App\Livewire;

use Livewire\Component;
use Filament\Forms\Form;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Concerns\InteractsWithForms;
use Phpsa\FilamentPasswordReveal\Password as FilamentPassword;

class Login extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
                ->schema([
                    TextInput::make('email')
                        ->label('Email')
                        ->placeholder('Enter your email')
                        ->email()
                        ->required(),
                    FilamentPassword::make('password')
                        ->password()
                        ->maxLength(255)
                        ->placeholder('Enter your password')
                        ->required()
                ])->statePath('data');
    }

    public function submit()
    {
        try{
            if (Auth::attempt($this->data)) {
                request()->session()->regenerate();
                return redirect()->to(route('home'));
            }else{
                throw new \Exception('Please Make Sure Your Creadentials is Correct!');
            }
        }catch(\Exception $e)
        {
            Notification::make()
                ->title('Failed to Login')
                ->body($e->getMessage())
                ->danger()
                ->send();
        }
    }

    public function render()
    {
        return view('livewire.login')->layout('layouts.app');
    }
}
