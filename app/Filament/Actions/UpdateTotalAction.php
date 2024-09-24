<?php
use Filament\Actions\Action;
use Illuminate\Support\Facades\DB;

class UpdateTotalAction extends Action
{
    public static $name = 'Update Total';

    public function handle()
    {
        $pelanggan = Pelanggan::all();

        foreach ($pelanggan as $data) {
            $total = DB::table('pelanggancustomer')
                ->where('no account', $data->no_account)
                ->sum('tagihan');

            $data->total = $total;
            $data->save();
        }

        $this->notify(__('Total updated successfully.'));

        return redirect()->back();
    }
}
