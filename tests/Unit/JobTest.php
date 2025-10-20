<?php

use App\Models\Employer;
use App\Models\Job;

it('belongs to an employer', function () {
    // AAA
    //Arrange
    $employer = Employer::factory()->create();
    $job = Job::factory()->create([
        'employer_id' => $employer->id,
    ]);

    // Act
    // $job->employer()

    // Act and Assert, aqui vamos fazer os 2 juntos
    expect($job->employer->is($employer))->toBeTrue();
});

it('can have tags', function () {
    // AAA
    $job = Job::factory()->create();

    $job->tag('Frontend');

    // Verificar
    expect($job->tags)->toHaveCount(1);
});
