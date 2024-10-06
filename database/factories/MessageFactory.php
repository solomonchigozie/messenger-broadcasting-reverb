<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $senderid = $this->faker->randomElement([0,1]);
        if($senderid ===0){
            $senderid = $this->faker
                ->randomElement(\App\Models\User::where('id','!=',1)->pluck('id')->toArray());
            $receiverId = 1;
        }else{
            $receiverId = $this->faker
            ->randomElement(\App\Models\User::pluck('id')->toArray());
        }

        $groupId = null;
        if($this->faker->boolean(50)) {
            $groupId = $this->faker->randomElement(\App\Models\Group::pluck('id')->toArray());
            //select group by group id
            $group = \App\Models\Group::find($groupId);
            $senderid = $this->faker->randomElement($group->users->pluck('id')->toArray());
            $receiverId = null;
        }

        return [
            'sender_id' => $senderid,
            'receiver_id' => $receiverId,
            'group_id' => $groupId,
            'message' => $this->faker->realText(200),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now')
        ];
    }
}
