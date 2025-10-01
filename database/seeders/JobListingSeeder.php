<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CompanyPicture;
use App\Models\JobListing;
use Faker\Factory as Faker;

class JobListingSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $companyPictures = [];
        for ($i = 1; $i <= 10; $i++) {
            $companyPictures[] = CompanyPicture::create([
                'company_name' => $faker->company(),
                'picture_path' => 'company_' . $i . '.jpg',
            ]);
        }

        foreach (range(1, 50) as $index) {
            $company = $faker->randomElement($companyPictures);

            JobListing::create([
                'position' => $faker->jobTitle(),
                'company_id' => $company->id,
                'location' => $faker->city(),
                'detail_location' => $faker->address(),
                'min_experience' => $faker->numberBetween(0, 5),
                'publish_at' => $faker->date(),
                'expired_date' => $faker->dateTimeBetween('+1 days', '+30 days')->format('Y-m-d'),
                'description' => $faker->paragraph(),
            ]);
        }
    }
}
