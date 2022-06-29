<?php

namespace App\Http\Livewire\Admin;

use App\Enums\UserRole;
use App\Enums\UserStatus;
use App\Enums\VerificationTypes;
use App\Models\User;
use App\Models\UserVerification;
use App\Models\VerificationType;
use Illuminate\Support\Str;
use Mediconesystems\LivewireDatatables\Action;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Spatie\Permission\Models\Role;

class VerificationRequestsTable extends LivewireDatatable
{
    public $persistComplexQuery = true;
    public $afterTableSlot = 'components.selected';
    public $hideable = 'inline';
    public $exportable = true;


    public $model = User::class;

    public function builder()
    {
        return UserVerification::where('status','pending');
    }

    public function columns()
    {
       return [
           Column::name('user.account_id')->label('Account ID'),

           Column::callback(['last_name','first_name'], function ($last_name,$first_name) {
               return $last_name.' '.$first_name;
           })->exportCallback(function ($last_name,$first_name){
               return $last_name.' '.$first_name;
           })->searchable()->label('Name'),

           Column::name('email')->searchable()->label('Email'),

           Column::callback(['verification_type_id'], function ($verification_type) {
               if(VerificationType::find($verification_type)->slug == Str::slug(VerificationTypes::ADDRESS())){
                   return 'Address Verification';
               }else{
                   return 'ID Verification';
               }
           })->searchable()->label('Type'),


           Column::callback(['status'], function ($status) {
               return '<span class="badge badge-danger badge-sm">'.$status.'</span>';
           })->exportCallback(function ($status){
               return $status;
           })->label('Status'),

           DateColumn::name('created_at')
               ->label('Request Date'),

           Column::callback(['id','last_name', 'first_name'], function ($id,$last_name,$first_name) {
               return view('admin.user.verification-table-actions', ['id' => $id,  'name'=>$last_name.' '.$first_name]);
           })->unsortable()->label('Action')->excludeFromExport()
       ];
    }

    public function getUserProperty()
    {
        return User::get();
    }


    public function buildActions()
    {
        return [
            Action::groupBy('Export Options', function () {
                return [
                    Action::value('pdf')->label('Export PDF')->export('Products.pdf'),
                    Action::value('csv')->label('Export CSV')->export('Products.csv'),
                    Action::value('html')->label('Export HTML')->export('Products.html'),
                    Action::value('xlsx')->label('Export XLSX')->export('Products.xlsx')->styles($this->exportStyles)->widths($this->exportWidths)
                ];
            }),
        ];
    }

    public function getExportStylesProperty()
    {
        return [
            '1'  => ['font' => ['bold' => true]],
            'B2' => ['font' => ['italic' => true]],
            'C'  => ['font' => ['size' => 16]],
        ];
    }

    public function getExportWidthsProperty()
    {
        return [
            'A' => 55,
            'B' => 45,
        ];
    }
}
