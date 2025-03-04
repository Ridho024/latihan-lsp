<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ScheduleResource\Pages;
use App\Filament\Resources\ScheduleResource\RelationManagers;
use App\Models\Schedule;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ScheduleResource extends Resource
{
    protected static ?string $model = Schedule::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_maskapai')
                    ->label('Nama Maskapai')
                    ->inputMode('numeric'),
                DatePicker::make('tanggal_berangkat')
                    ->label('Tanggal Berangkat'),
                DatePicker::make('tanggal_sampai')
                    ->label('Tanggal Sampai'),
                TimePicker::make('waktu_berangkat')
                    ->label('Waktu Berangkat'),
                TimePicker::make('waktu_sampai')
                    ->label('Waktu Sampai'),
                TextInput::make('bandara_asal')
                    ->label('Bandara Asal'),
                TextInput::make('bandara_tujuan')
                    ->label('Bandara Tujuan'),
                TextInput::make('kursi_tersedia')
                    ->label('Kursi Tersedia'),
                TextInput::make('harga_per_kursi')
                    ->label('Harga per Kursi')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_maskapai')->label('Nama Maskapai'),
                TextColumn::make('tanggal_berangkat')->label('Tanggal Berangkat'),
                TextColumn::make('tanggal_sampai')->label('Tanggal Sampai'),
                TextColumn::make('waktu_berangkat')->label('Waktu Berangkat'),
                TextColumn::make('waktu_sampai')->label('Waktu Sampai'),
                TextColumn::make('bandara_asal')->label('Bandara Asal'),
                TextColumn::make('bandara_tujuan')->label('Bandara Tujuan'),
                TextColumn::make('kursi_tersedia')->label('Kursi Tersedia'),
                TextColumn::make('harga_per_kursi')->label('Harga per Kursi')
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
            'index' => Pages\ListSchedules::route('/'),
            'create' => Pages\CreateSchedule::route('/create'),
            'edit' => Pages\EditSchedule::route('/{record}/edit'),
        ];
    }
}
