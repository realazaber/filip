<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactResource\Pages;
use App\Filament\Resources\ContactResource\RelationManagers;
use App\Filament\Traits\UserCreateForm;
use App\Filament\Traits\UserResource;
use App\Models\Contact;
use App\Models\Patient;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContactResource extends Resource
{
    use UserResource;
    protected static ?string $model = Contact::class;

    protected static ?string $navigationIcon = 'fas-phone';

    protected static ?int $navigationSort = 4;


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
                Forms\Components\Select::make('patient_id')
                    ->label('Patient')
                    ->options(function () {
                        // load patients with their user to build the label
                        return Patient::with('user')

                            ->get()
                            ->mapWithKeys(function ($patient) {
                                $user = $patient->user;
                                $label = $user
                                    ? trim(($user->first_name ?? '') . ' ' . ($user->last_name ?? '') ?: ($user->name ?? 'Unknown'))
                                    : 'Unknown';
                                return [$patient->id => $label];
                            })->toArray();
                    })
                    ->searchable()    // enables filtering in the select dropdown
                    ->required(),

                Forms\Components\Textarea::make('relationship')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.full_name')
                    ->label('Name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('patient.user.first_name')
                    ->label('Patient')
                    ->searchable()
                    ->sortable()
                    ->formatStateUsing(function ($state, Contact $contact) {
                        return $contact->patient->user->first_name . ' ' . $contact->patient->user->last_name;
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListContacts::route('/'),
            'create' => Pages\CreateContact::route('/create'),
            'edit' => Pages\EditContact::route('/{record}/edit'),
        ];
    }
}
