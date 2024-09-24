<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GsmdiidResource\Pages;
use App\Filament\Resources\GsmdiidResource\RelationManagers;
use App\Models\Gsmdiid;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GsmdiidResource extends Resource
{
    protected static ?string $model = Gsmdiid::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Data GS';

    protected static ?string $navigationLabel = 'Company';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('no_account')
                    ->label('NO MDIID'),
                Forms\Components\TextInput::make('nama')
                    ->label('NAMA PELANGGAN'),
                Forms\Components\Select::make('pph')
                ->label('PPH')   
                ->options([
                        'YES' => 'YES',
                        'NO' => 'NO',
                        '-' => '-',
                    ])
                    ->native(false)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('no_account')
                    ->searchable()
                    ->label('NO MDIID'),
                Tables\Columns\TextColumn::make('nama')
                    ->searchable()
                    ->label('PELANGGAN'),
                //Tables\Columns\TextColumn::make('total'),
                //->counts('Pelanggancustomers'),
                    // ->value(function ($record) {
                    //     // Hitung total tagihan untuk setiap pelanggan
                    //     $totalTagihan = Pelanggancustomer::where('no_id', $record->no_id)->sum('tagihan');
                    //     return $totalTagihan;
                    // }),                           
                Tables\Columns\TextColumn::make('pph')
                    ->label('PPH')    
                    ->searchable(),
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
            'index' => Pages\ListGsmdiids::route('/'),
            'create' => Pages\CreateGsmdiid::route('/create'),
            'edit' => Pages\EditGsmdiid::route('/{record}/edit'),
        ];
    }
}
