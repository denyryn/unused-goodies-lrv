<?php

namespace App\Filament\Resources;

use App\Enums\ProductStatusEnum;
use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Model;
use Str;


class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-archive-box';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Product Name')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state))),
                TextInput::make('slug')
                    ->label('Short Name')
                    ->required()
                    ->unique('products', 'slug', ignoreRecord: true),
                Select::make('category_id')
                    ->label('Category')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('status')
                    ->label('Status')
                    ->options(collect(\App\Enums\ProductStatusEnum::cases())->mapWithKeys(fn($case) => [$case->value => $case->label()]))
                    ->default(\App\Enums\ProductStatusEnum::ACTIVE->value),
                TextInput::make('stock')
                    ->required()
                    ->numeric(),
                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('RP'),
                RichEditor::make('description')
                    ->label('Product Description')
                    ->required()
                    ->columnSpanFull(),
                Repeater::make('productImages')
                    ->label('Product Images')
                    ->relationship()
                    ->addActionLabel('Add Product Image')
                    ->itemLabel(function () {
                        static $position = 1;
                        return 'Image ' . $position++;
                    })
                    ->schema([
                        FileUpload::make('image_path')
                            ->label('Image')
                            ->required()
                            ->image()
                            ->directory('product-images')
                            ->columnSpanFull(),
                    ])
                    ->defaultItems(1)
                    ->grid(2)
                    ->maxItems(10)
                    ->reorderable(true)
                    ->reorderableWithDragAndDrop(true)
                    ->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('slug')
                    ->searchable(),
                TextColumn::make('stock'),
                TextColumn::make('sku')
                    ->label('SKU')
                    ->default('N/A')
                    ->searchable()
                    ->copyable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state) => match (ProductStatusEnum::tryFrom($state)) {
                        ProductStatusEnum::INACTIVE => 'danger',
                        ProductStatusEnum::BOOKED,
                        ProductStatusEnum::ARCHIVED => 'warning',
                        ProductStatusEnum::ACTIVE => 'success',
                        default => 'secondary', // Optional: handle unexpected values
                    }),
                TextColumn::make('category.name'),
                TextColumn::make('price')
                    ->money('IDR')
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options(collect(\App\Enums\ProductStatusEnum::cases())->mapWithKeys(fn($case) => [$case->value => $case->label()]))
            ])
            ->actions([
                Tables\Actions\DeleteAction::make()->requiresConfirmation(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->requiresConfirmation(),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
