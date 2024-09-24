<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GspelangganResource\Pages;
use App\Filament\Resources\GspelangganResource\RelationManagers;
use App\Models\Gspelanggan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GspelangganResource extends Resource
{
    protected static ?string $model = Gspelanggan::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'Data GS';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('no_customer')
                    ->label('NO TELEPON'),
                Forms\Components\Select::make('gsmdiid_id')
                    ->relationship('gsmdiid', 'no_account')
                    ->searchable()
                    ->label('NO MDIID')
                    ->preload()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('gsmdiid.no_account')
                    ->searchable()
                    ->label('NO MDIID'),
                Tables\Columns\TextColumn::make('gsmdiid.nama')
                    ->searchable()
                    ->label('PELANGGAN'),
                Tables\Columns\TextColumn::make('no_customer')
                    ->searchable()
                    ->label('NO TELEPON'),
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
            'index' => Pages\ListGspelanggans::route('/'),
            'create' => Pages\CreateGspelanggan::route('/create'),
            'edit' => Pages\EditGspelanggan::route('/{record}/edit'),
        ];
    }
}
