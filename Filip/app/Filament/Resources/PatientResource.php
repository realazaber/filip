<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PatientResource\Pages;
use App\Filament\Traits\UserCreateForm;
use App\Models\Patient;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PatientResource extends Resource
{
    protected static ?string $model = Patient::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 3;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make('User Information')
                    ->relationship('user')
                    ->schema(
                        UserCreateForm::get(),
                    )

                    ->columns(2),
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),

            ]);
    }



    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.first_name')
                    ->label('Name')
                    ->searchable()
                    ->sortable()
                    ->formatStateUsing(function ($state, Patient $patient) {
                        return $patient->user->first_name . ' ' . $patient->user->last_name;
                    }),
                Tables\Columns\TextColumn::make('user.created_at')
                    ->label('Created At')
                    ->date()
                    ->sortable(),

                Tables\Columns\TextColumn::make('user.updated_at')
                    ->label('Updated At')
                    ->date()
                    ->sortable(),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),

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
            'index' => Pages\ListPatients::route('/'),
            'create' => Pages\CreatePatient::route('/create'),
            'edit' => Pages\EditPatient::route('/{record}/edit'),
        ];
    }
}
