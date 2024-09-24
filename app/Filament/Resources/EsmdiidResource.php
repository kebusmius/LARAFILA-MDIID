<?php

namespace App\Filament\Resources;

use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use App\Filament\Resources\EsmdiidResource\Pages;
use App\Filament\Resources\EsmdiidResource\RelationManagers;
use App\Models\Esmdiid;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SelectedDataExport;



class EsmdiidResource extends Resource implements HasShieldPermissions
{
    protected static ?string $model = Esmdiid::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Data ES';

    protected static ?string $navigationLabel = 'Perusahaan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('no_account')
                    ->label('NO MDIID'),
                Forms\Components\TextInput::make('nama')
                    ->label('NAMA PERUSAHAAN'),
                Forms\Components\TextInput::make('total')
                    ->disabled()
                    // ->required()
                    ->numeric(),
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
                // Tables\Columns\TextColumn::make('no')
                //     ->label('No')
                //     ->getStateUsing(fn ($rowLoop, $record) => $rowLoop->iteration),
                Tables\Columns\TextColumn::make('no_account')
                    ->label('NO MDIID')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama')
                    ->label('PELANGGAN')
                    ->searchable(),                        
                Tables\Columns\TextColumn::make('pph')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        '-' => 'gray',                    
                        'YES' => 'success',
                        'NO' => 'danger',
                    })
                    ->label('PPH')    
                    ->searchable(),
                Tables\Columns\TextColumn::make('total')
                    ->numeric()
                    ->label('Total Transaksi')->getStateUsing(function ($record) {
                    return $record->total;
                    
                    }),
                    
                    
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
                    Tables\Actions\BulkAction::make('export')
                    ->label('Export Selected')
                    ->color('success')
                    ->action(function (Collection $records) {
                        // Konversi collection ke array
                        $recordsArray = $records->map->only(['no_account', 'nama', 'total', 'pph']);

                        // Buat instance ekspor dengan data terpilih
                        return Excel::download(new SelectedDataExport($recordsArray), 'selected-records-' . date('Y-m-d') . '.xlsx');
                    })
                    ->requiresConfirmation() // Konfirmasi sebelum export (opsional)
                        ->icon('heroicon-s-arrow-down-tray'),
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
            'index' => Pages\ListEsmdiids::route('/'),
            'create' => Pages\CreateEsmdiid::route('/create'),
            // 'view' => Pages\ViewEsmdiid::route('/{record}'),
            'edit' => Pages\EditEsmdiid::route('/{record}/edit'),
        ];
    }

    public static function getPermissionPrefixes(): array
    {
        return [
            'view',
            'view_any',
            'create',
            'update',
            'delete',
            'delete_any',
            
        ];
    }

    // public function map($record): array
    // {
    //     return [
    //         $record->no_account,
    //         $record->nama,
    //         $record->pph,
    //         $record->total,
    //         // Kolom lainnya...
    //     ];
    // }   

    // public function headings(): array
    // {
    //     return [
    //         'No_account',
    //         'Nama',
    //         'pph',
    //         'total',
    //         // Header kolom lainnya...
    //     ];
    // }
}
