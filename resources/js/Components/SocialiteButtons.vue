<script setup>
// Socialite currently supports authentication via
// Facebook, Twitter, LinkedIn, Google, GitHub, GitLab, Bitbucket, and Slack.
//  We have currently tested support for [gitHub, google]
/**
 * Along with form based authentication, Laravel also provides a simple, convenient way to authenticate with OAuth providers using Laravel Socialite.
 * Socialite currently supports authentication via Facebook, Twitter, LinkedIn, Google, GitHub, GitLab, Bitbucket, and Slack.
 * The provider can be one of [github, google, facebook, twitter, linkedin, gitLab, bitbucket, and slack]
 * We have currently tested for providers [github, google]
 */
import {mdiGithub, mdiGoogle, mdiTwitter, mdiFacebook, mdiLinkedin, mdiGitlab, mdiBitbucket, mdiSlack} from "@mdi/js";

defineProps({
    login: { type: Boolean, default: false, },
    icon: { type: Boolean, default: false, },

    // Social providers supported.
    github: { type: Boolean, default: true, },
    google: { type: Boolean, default: true, },
    twitter: { type: Boolean, default: false, },
    facebook: { type: Boolean, default: false, },
    linkedin: { type: Boolean, default: false, },
    gitlab: { type: Boolean, default: false, },
    bitbucket: { type: Boolean, default: false, },
    slack: { type: Boolean, default: false, },
});
</script>

<template>
    <div class="flex items-center justify-center mt-4" data-cy="socialiteButtons">
        <!-- Login or Register -->
        <v-label v-if="login" class="mr-4" data-cy="socialiteButtonsLabel">Login with</v-label>
        <v-label v-if="!login" class="mr-4" data-cy="socialiteButtonsLabel">Register with</v-label>

        <!-- Social buttons to display -->
        <!-- Github social button -->
        <v-btn v-if="github && !icon" :prepend-icon="!icon ? mdiGithub : null" href="/auth/github/redirect" class="mr-2" data-cy="github">{{ !icon ? 'Github' : null}}</v-btn>
        <v-btn v-else-if="github && icon" :icon="icon ? mdiGithub : null" href="/auth/github/redirect" class="mr-2" data-cy="github"></v-btn>
        <!-- Google social button -->
        <v-btn v-if="google && !icon" :prepend-icon="!icon ? mdiGoogle : null" href="/auth/google/redirect" class="mr-2" data-cy="google">{{ !icon ? 'Google' : null}}</v-btn>
        <v-btn v-else-if="google && icon" :icon="icon ? mdiGoogle : null" href="/auth/google/redirect" class="mr-2" data-cy="google"></v-btn>
        <!-- Twitter social button -->
        <v-btn v-if="twitter && !icon" :prepend-icon="!icon ? mdiTwitter : null" href="/auth/twitter/redirect" class="mr-2" data-cy="twitter">{{ !icon ? 'Twitter' : null}}</v-btn>
        <v-btn v-else-if="twitter && icon" :icon="icon ? mdiTwitter : null" href="/auth/twitter/redirect" class="mr-2" data-cy="twitter"></v-btn>
        <!-- Facebook social button -->
        <v-btn v-if="facebook && !icon" :prepend-icon="!icon ? mdiFacebook : null" href="/auth/facebook/redirect" class="mr-2" data-cy="facebook">{{ !icon ? 'Facebook' : null}}</v-btn>
        <v-btn v-else-if="facebook && icon" :icon="icon ? mdiFacebook : null" href="/auth/facebook/redirect" class="mr-2" data-cy="facebook"></v-btn>
        <!-- Linkedin social button -->
        <v-btn v-if="linkedin && !icon" :prepend-icon="!icon ? mdiLinkedin : null" href="/auth/linkedin/redirect" class="mr-2" data-cy="linkedin">{{ !icon ? 'Linkedin' : null}}</v-btn>
        <v-btn v-else-if="linkedin && icon" :icon="icon ? mdiLinkedin : null" href="/auth/linkedin/redirect" class="mr-2" data-cy="linkedin"></v-btn>
        <!-- Gitlab social button -->
        <v-btn v-if="gitlab && !icon" :prepend-icon="!icon ? mdiGitlab : null" href="/auth/gitlab/redirect" class="mr-2" data-cy="gitlab">{{ !icon ? 'Gitlab' : null}}</v-btn>
        <v-btn v-else-if="gitlab && icon" :icon="icon ? mdiGitlab : null" href="/auth/gitlab/redirect" class="mr-2" data-cy="gitlab"></v-btn>
        <!-- Bitbucket social button -->
        <v-btn v-if="bitbucket && !icon" :prepend-icon="!icon ? mdiBitbucket : null" href="/auth/bitbucket/redirect" class="mr-2" data-cy="bitbucket">{{ !icon ? 'Bitbucket' : null}}</v-btn>
        <v-btn v-else-if="bitbucket && icon" :icon="icon ? mdiBitbucket : null" href="/auth/bitbucket/redirect" class="mr-2" data-cy="bitbucket"></v-btn>
        <!-- Slack social button -->
        <v-btn v-if="slack && !icon" :prepend-icon="!icon ? mdiSlack : null" href="/auth/slack/redirect" class="mr-2" data-cy="slack">{{ !icon ? 'Slack' : null}}</v-btn>
        <v-btn v-else-if="slack && icon" :icon="icon ? mdiSlack : null" href="/auth/slack/redirect" class="mr-2" data-cy="slack"></v-btn>
    </div>
</template>
