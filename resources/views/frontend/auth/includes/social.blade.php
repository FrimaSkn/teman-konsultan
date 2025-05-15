<x-frontend.basic.button
    :href="route('frontend.auth.social.login', 'bitbucket')"
    size="sm"
    class="btn btn-sm"
    icon="fab fa-bitbucket"
    :label="__('Login with Bitbucket')"
    :hide="!config('services.bitbucket.active')" />

<x-frontend.basic.button
    :href="route('frontend.auth.social.login', 'facebook')"
    size="sm"
    class="btn btn-sm"
    icon="fab fa-facebook"
    :label="__('Login with Facebook')"
    :hide="!config('services.facebook.active')" />

<x-frontend.basic.button
    :href="route('frontend.auth.social.login', 'google')"
    size="sm"
    class="btn btn-sm"
    icon="fab fa-google"
    :label="__('Login with Google')"
    :hide="!config('services.google.active')" />

<x-frontend.basic.button
    :href="route('frontend.auth.social.login', 'github')"
    size="sm"
    class="btn btn-sm"
    icon="fab fa-github"
    :label="__('Login with Github')"
    :hide="!config('services.github.active')" />

<x-frontend.basic.button
    :href="route('frontend.auth.social.login', 'linkedin')"
    size="sm"
    class="btn btn-sm"
    icon="fab fa-linkedin"
    :label="__('Login with Linkedin')"
    :hide="!config('services.linkedin.active')" />

<x-frontend.basic.button
    :href="route('frontend.auth.social.login', 'twitter')"
    size="sm"
    class="btn btn-sm"
    icon="fab fa-twitter"
    :label="__('Login with Twitter')"
    :hide="!config('services.twitter.active')" />
