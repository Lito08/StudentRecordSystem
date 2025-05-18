<?php

it('returns a successful response', function () {
    $response = $this->get('/');
    $response->assertStatus(302)        // home now redirects to /login
             ->assertRedirect('/login');
});
