<?php

namespace App\Http\Resources;

use App\Http\Controllers\DateController;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        $table->string('mobile');
        $table->string('phone')->nullable();
        $table->string('password')->nullable();
        $table->string('role')->default('user');// author, admin
        $table->string('type')->default('person');// company
        $table->string('national_id')->nullable();//role user
        $table->string('publish_code')->nullable();//for companies
        $table->string('birth_date')->nullable();//for persons
        $table->integer('city_id')->constrained('cities')->default(301);
        $table->string('postal_code')->nullable();
        $table->text('address')->nullable();
        $table->string('image')->nullable();
        $table->rememberToken();
        $table->timestamps();
        return [
            'id' => $this->id,
            'name' => $this->name,
            'contact_person' => $this->contact_person,
            'email' => $this->email,
            'email_verified_at' => $this->email_verified_at,
            'mobile' => $this->mobile,
            'phone' => $this->phone,
            'password' => $this->password,
            'role' => $this->role,
            'type' => $this->type,
            'national_id' => $this->national_id,
            'publish_code' => $this->publish_code,
            'birth_date' => $this->birth_date,
            'city_id' => $this->city_id,
            'postal_code' => $this->postal_code,
            'address' => $this->address,
            'image' => $this->image,

            'city' => [
                'id' => $this->city?->id,
                'name' => $this->city?->name
            ],
            'province' => [
                'id' => $this->city?->province->id,
                'name' => $this->city?->province->name
            ],
            'created_at' => explode(' ', (new DateController())->toPersian($this->created_at))[0],

        ];
    }
}
