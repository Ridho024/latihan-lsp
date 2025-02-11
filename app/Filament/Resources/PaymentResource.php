<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use App\Models\Booking;
use App\Models\Payment;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PaymentResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PaymentResource\RelationManagers;

class PaymentResource extends Resource
{
    protected static ?string $model = Payment::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                    ->label('Email User')
                    ->options(User::all()->pluck('email', 'id'))
                    ->searchable(),
                Select::make('booking_id')
                    ->label('Booking ID')
                    ->options(Booking::all()->where('user_id','=', Auth::id()))
                    ->searchable(),
                TextInput::make('email')
                    ->label('Email')
                    ->options(User::all()->pluck('email', 'email')),
                Select::make('metode_pembayaran')
                    ->label('Metode Pembayaran')
                    ->options(['cash', 'debit']),
                TextInput::make('nomor_kartu')
                    ->lable('Nomor Kartu')
                    ->numeric(),
                TextInput::make('total_pembayaran')
                    ->label('Total Pembayaran')
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user_id')
                    ->label('Email')
                    ->formatStateUsing(fn ($record) => $record->user?->email),
                TextColumn::make('booking_id')
                    ->label('ID Booking'),
                TextColumn::make('metode_pembayaran')->label('Metode Pembayaran'),
                TextColumn::make('nomor_kartu')->label('Nomor Kartu'),
                TextColumn::make('total_pembayaran')->label('Total Pembayaarn'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPayments::route('/'),
            'create' => Pages\CreatePayment::route('/create'),
            'edit' => Pages\EditPayment::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
