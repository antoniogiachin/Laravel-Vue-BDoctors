<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Doctor;
use App\User;
use App\Specialty;
use Illuminate\Support\Str;

class DoctorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $specialties = Specialty::all();
        $specialtyId = [];
        foreach ($specialties as $specialty){
            $specialtyId[] = intval($specialty->id);
        }
        $specialtyPlaceHolder = [];
        for($i = 0; $i <= $faker->numberBetween(1,4); $i++) {
            $specialtyPlaceHolder[] = (intval(floor(count($specialtyId) / $faker->randomDigitNotNull())));
        }
        for($i = 1; $i <= 30; $i++) {
          $newUser = new User();
          $newUser->name = $faker->unique()->firstName;
          $newUser->surname = $faker->unique()->lastName;
          $newUser->email = $faker->unique()->email;
          $newUser->address = $faker->address;
          $newUser->password = Hash::make($faker->numerify('user-####'));
          $newUser->save();
          $newDoctor = new Doctor();
          $newDoctor->phone = $faker->phoneNumber;
          $newDoctor->medical_address = $faker->address;
          $newDoctor->cv = 'doc_cv/' . $faker->image('public/storage/doc_cv',400,600, null, false);
          $newDoctor->photo = 'doc_img/' . $faker->unique()->image('public/storage/doc_img',400,300, null, false) ;
          $newDoctor->performance = $faker->paragraph;
          $newDoctor->slug = $faker->unique()->lexify('slug-????');
          $newDoctor->user_id = $newUser->id;
          $newDoctor->save();
          $newDoctor->slug = Str::slug($newDoctor->user['name'] .'-'. $newDoctor->user['surname']);
          $newDoctor->save();
          $newDoctor->specialties()->sync($specialtyPlaceHolder);
          $specialtyPlaceHolder = [];
          $specialtyPlaceHolder[] = $faker->randomElement($specialtyId, 3);
          $boolPlaceholder = null;
          if($boolPlaceholder == $faker->boolean){
              $specialtyPlaceHolder[] = $faker->randomElement($specialtyId, 6);
          }
          if($boolPlaceholder == $faker->boolean){
              $specialtyPlaceHolder[] = $faker->randomElement($specialtyId, 1);
          }
          if($boolPlaceholder == $faker->boolean){
              $specialtyPlaceHolder[] = $faker->randomElement($specialtyId, 5);
          }

        }
    }
}
