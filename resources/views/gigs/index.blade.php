@extends('layout')
@section('content')

<x-navigation />

<main>
    <x-section class="top-margin-section"></x-section>
    <x-section>
        <div class="gigs">
            <h2>Gigs so far</h2>

            <div class="gig-list">
                <table>
                    <thead>
                        <th> Venue </th>
                        <th> Where </th>
                        <th> When </th>
                        <th> Gallery </th>
                    </thead>
                    <tbody>
                        @foreach ($gigs as $gig)
                        <x-gig-card :gig='$gig' />
                        @endforeach
                    </tbody>
                </table>
            </div>
    </x-section>
</main>