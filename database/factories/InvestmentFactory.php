<?php

namespace Database\Factories;

use App\Models\Investment;
use App\Models\Package;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvestmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Investment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $package =  Package::all()->random();
        return [
            'package_id' => $package->id,
            'amount' => $package->amount,
            'balance' => $package->amount * 2,
            'gateway' => $this->faker->randomElement($array = array('paystack', 'wallet', 'bank')),
            'status' => $this->faker->randomElement($array = array('approved', 'pending', 'declined')),
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterMaking(function () {
            //
            $users = User::with('investments')->get();
            foreach ($users as $user) {
                foreach ($user->investments as $userinvest) {
                    if ($userinvest->status == 'approved' || $userinvest->status == 'declined') {
                        $investment = Investment::findOrFail($userinvest->id);
                        $investment->verified_at = now();
                        $investment->verified_by = User::where('admin', '=', true)->get()->random()->id;
                        $investment->save();
                    }
                }
            }
        });
    }

    // ...
}
