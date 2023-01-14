<template>
    <div class="columns is-mobile is-centered">
        <div class="column is-four-fifths has-background-white my-6">
            <b-tabs type="is-boxed" destroyOnHide>
                <b-tab-item label="Posts" icon="google-photos">
                    <ProfilePosts/>
                </b-tab-item>
                <b-tab-item label="Friends" icon="library-music">
                    <Friends/>
                </b-tab-item>
                <b-tab-item label="Details" icon="video"></b-tab-item>
            </b-tabs>
        </div>
    </div>
</template>

<script>
import ProfilePosts from "./ProfilePosts.vue";
import Friends from "./ProfileFriend/ProfileFriendsIndex.vue";
export default {
    components: {ProfilePosts, Friends}
}
</script>
