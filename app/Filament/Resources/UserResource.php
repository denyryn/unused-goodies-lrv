<?php

namespace App\Filament\Resources;

use App\Enums\RoleEnum;
use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('email')
                    ->email()->required(),
                Radio::make('role')
                    ->options(collect(RoleEnum::cases())->mapWithKeys(fn($case) => [$case->value => $case->label()]))
                    ->required(),
                TextInput::make('password')->password()->required(),
                TextInput::make('name')
                    ->label('Full Name'),
                TextInput::make('phone')
                    ->label('Phone Number'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->searchable(),
                TextColumn::make('email')
                    ->searchable()
                    ->copyable(),
                TextColumn::make('role')
                    ->badge()->color(fn(RoleEnum $state): string => match ($state) {
                        RoleEnum::ADMIN => 'danger',
                        RoleEnum::USER => 'success',
                    }),
                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->label('Full Name'),
                TextColumn::make('phone')
                    ->searchable()
                    ->label('Phone Number'),
            ])
            ->filters([
                SelectFilter::make('role')
                    ->options(collect(RoleEnum::cases())->mapWithKeys(fn($case) => [$case->value => $case->label()]))
            ])
            ->actions([
                Tables\Actions\DeleteAction::make()->requiresConfirmation(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
