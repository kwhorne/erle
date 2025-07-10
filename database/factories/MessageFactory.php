<?php

namespace Database\Factories;

use App\Models\User;
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
        $employees = User::where('is_employee', true)->pluck('id')->toArray();
        
        return [
            'sender_id' => fake()->randomElement($employees),
            'recipient_id' => fake()->randomElement($employees),
            'subject' => fake()->sentence(4),
            'body' => fake()->paragraph(3),
            'priority' => fake()->randomElement(['low', 'normal', 'high', 'urgent']),
            'read_at' => fake()->optional(0.6)->dateTimeBetween('-1 week', 'now'),
            'created_at' => fake()->dateTimeBetween('-1 month', 'now'),
        ];
    }

    /**
     * Create an unread message.
     */
    public function unread(): static
    {
        return $this->state(fn (array $attributes) => [
            'read_at' => null,
        ]);
    }

    /**
     * Create a high priority message.
     */
    public function highPriority(): static
    {
        return $this->state(fn (array $attributes) => [
            'priority' => fake()->randomElement(['high', 'urgent']),
        ]);
    }
}
