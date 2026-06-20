<?php

test('api vacancies route returns 200', function () {
    $response = $this->getJson('/api/v1/vacancies');
    $response->assertStatus(200);
});

test('api lecturers route returns 200', function () {
    $response = $this->getJson('/api/v1/lecturers');
    $response->assertStatus(200);
});

test('api profile route returns 404 for non-existent nim', function () {
    $response = $this->getJson('/api/v1/profile/invalid-nim');
    $response->assertStatus(404);
});
