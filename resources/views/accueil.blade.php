@extends('base')

@section('title')
Trellix - InternHub
@endsection

@section('content')

<div class="container container-perso-t">

    <div class="accroche">
        <div class="accroche-image">
            <div>
                <img class="img-a" src="{{ asset('storage/logo-t.png')}}" alt="" height="70" width="70">
                <img class="img-b" src="{{ asset('storage/1.png')}}" alt="">
            </div>
        </div>
        <div class="accroche-titre">
            <div class="accroche-titres">
                <h2>Trellix</h2>
                <h1>INTERNHUB</h1>
            </div>
            <div class="accroche-texte">
                Boost your career with Internhub, the essential platform for finding internships and jobs at Trellix.
            </div>
            @auth
            <a href="{{ route('offers')}}">
                <div class="accroche-btn btn-violet">
                    Offers
                </div>
            </a>
            @endauth
            @guest
            <a href="{{ route('signin')}}">
                <div class="accroche-btn btn-violet">
                    Sing in
                </div>
            </a>
            @endguest

        </div>
    </div>

    <div class="ex">
        <div class="what">
            <div class="ex-titre">
                <h1>WHAT</h1>
            </div>
            <div class="ex-description">
                <div class="ex-description-titre">
                    <h2>What is Trellix - InternHub ?</h2>
                </div>
                <div class="ex-description-texte">
                    <p>Trellix - Internhub is a web solution that meets the growing needs of
                    students and young professionals to find internships and jobs developed for Trellix.
                    Internhub offers an intuitive and user-friendly interface allowing users to easily browse available opportunities.</p>
                </div>
            </div>
        </div>
        <div class="why">
            <div class="ex-titre">
                <h1>WHY</h1>
            </div>
            <div class="ex-description">
                <div class="ex-description-titre">
                    <h2>Why Trellix - InternHub ?</h2>
                </div>
                <div class="ex-description-texte">
                    <p>By integrating Trellix internship offers into its database,
                    Internhub guarantees maximum visibility of the opportunities offered by this company.
                    By simplifying and centralizing the internship search process for students and young professionals interested in Trellix,
                     Internhub makes it easier to connect talented candidates with professional opportunities within the company.

                   In summary, Internhub simplifies and enriches the internship and job search process,
                    offering a comprehensive and accessible solution for anyone aspiring to develop their professional career.</p>
                </div>
            </div>
        </div>
        <div class="how">
            <div class="ex-titre">
                <h1>HOW</h1>
            </div>
            <div class="ex-description">
                <div class="ex-description-titre">
                    <h2>How to take advantage of Trellix - Internhub ?</h2>
                </div>
                <div class="ex-description-texte">
                    <p> Create your account to access numerous internship offers. Submit as many applications as you want from the opportunities offered by Trellix.
                     Obtain academic
                     or professional internships without leaving your home and benefit from a fully digitalized recruitment process,
                      from internship request to completion.</p>
                </div>
            </div>
        </div>
        <div class="go">
            <div class="ex-titre">
                <h1>GO</h1>
            </div>
            <div class="ex-description">
                <div class="ex-description-titre">
                    <h2>Start your experience with InternHub.</h2>
                </div>
                <a href="{{ route('offers')}}">
                    <div class="ex-description-btn accroche-btn">
                        Apply now
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

@endsection


