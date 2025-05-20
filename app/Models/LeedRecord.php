<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeedRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'name' ,

        'telegram' ,
        'whatsapp' ,
        'company' ,

        'comment' ,
//        'content',
        'client_id',
        'client_supplier_id', // Добавляем поле для связи с поставщиком клиента
        'order_product_types_id', // Добавляем поле для связи с поставщиком клиента

        'leed_column_id',
        'user_id',
        'otkaz_reason',
        'leed_id',
        'budget',

        'phone' ,
        'fio' ,


        'fio2',
        'phone2',
        'cooperativ',
        'price',
        'date_start',

        'platform',
        'base_number',
        'link',
        'submit_before',
        'payment_due_date',
        'pay_day_every_year',
        'pay_day_every_month',

        'email',
        'obj_tender',
        'zakazchick',
        'post_day_ot',
        'post_day_do',
        'mesto_dostavki',

        'number1', 'number2', 'number3', 'number4', 'number5', 'number6',
        'date1', 'date2', 'date3', 'date4',
        'dt1', 'dt2', 'dt3',
        'string1', 'string2', 'string3', 'string4',


    ];

    public function column()
    {
        return $this->belongsTo(LeedColumn::class, 'leed_column_id');
    }

    public function comments()
    {
        return $this->hasMany(Logs2::class);
    }

    public function orders()
    {
        return $this->hasMany(LeedRecordOrder::class);
    }

    public function supplier() // Добавляем метод для связи с ClientSupplier
    {
        return $this->belongsTo(ClientSupplier::class, 'client_supplier_id');
    }

    public function userAssignments() // Добавляем метод для связи с LeadUserAssignment
    {
        return $this->hasMany(LeadUserAssignment::class, 'lead_id');
    }


//    // Определение отношения один-ко-многим с LeadTransfer
//    public function transfers()
//    {
//        return $this->hasMany(LeadTransfer::class, 'lead_id');
//    }


    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function productTypes()
    {
        return $this->belongsTo(OrderProductType::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // Связь с моделью LeedRecord
    public function leedRecord()
    {
        return $this->belongsTo(LeedRecord::class, 'leed_id');
    }

    public function order()
    {
        return $this->hasOne(\App\Models\Order::class, 'id', 'order_id');
    }

    // Лид-рекорд имеет много комментариев
    public function leedComments()
    {
        return $this->hasMany(LeedRecordComment::class);
    }

    public function userChanges()
    {
        return $this->hasMany(LeedRecordUserChange::class);
    }

    public function notifications()
    {
        return $this->hasMany(LeedNotification::class, 'leed_id');
    }

}
