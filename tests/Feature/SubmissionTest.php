<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
use Illuminate\Testing\Fluent\AssertableJson;

use App\Models\Submission;
use App\Jobs\ProcessStoreSubmission;
use App\Events\SubmissionSaved;

class SubmissionTest extends TestCase
{
    public function test_submission_is_created_with_valid_data(): void
    {
        $submission = Submission::factory()->make();
        $response = $this->post(route('submissions.store'), $submission->toArray());
        $response->assertStatus(200);
        $this->assertDatabaseHas('submissions', [
            'name' => $submission->name,
            'email' => $submission->email
        ]);
    }

    public function test_submission_is_put_into_queue(): void
    {
        Queue::fake([
            ProcessStoreSubmission::class,
        ]);

        $submission = Submission::factory()->make();
        $response = $this->post(route('submissions.store'), $submission->toArray());
        $response->assertStatus(200);
        Queue::assertPushed(ProcessStoreSubmission::class);        
    }

    public function test_submission_is_created_then_event_is_trigger(): void
    {
        Event::fake([
            SubmissionSaved::class,
        ]);
        
        $submission = Submission::factory()->create();        

        Event::assertDispatched(
            SubmissionSaved::class
        );       
    }

    public function test_submission_isnt_created_with_invalid_data(): void
    {
        $submission = Submission::factory()->make(array(
            'name' => null,
            'email' => null,
            'message' => null
        ));
        $response = $this->post(route('submissions.store'), $submission->toArray());
        $response->assertStatus(422)
            ->assertJson(fn (AssertableJson $json) =>
                $json->hasAny('errors.name', 'errors.email', 'errors.message')
            );;

        $this->assertDatabaseMissing('submissions', [
            'name' => $submission->name,
            'email' => $submission->email
        ]);
    }
}
