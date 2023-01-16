<template>
  <div>
    <transition-group
      name="list"
      tag="div"
      class="meme"
    >
      <div
        v-for="post in posts"
        :key="post.id"
        class="column is-half is-offset-one-quarter p-3 has-background-white box"
      >
        <div class="is-flex">
          <img
            class="homefeed-placeholder-img mx-2"
            :src="post.user.avatar"
          >
          <span>{{ post.user.name }}</span>
        </div>
        <div>
          <span class="is-size-7"> {{ post.updated_at }} </span>
          <span v-if="post.type === 'PUBLIC'">
            <b-tooltip
              label="Public"
              type="is-dark"
              position="is-bottom"
            >
              <i
                class="fa-solid fa-bullhorn mx-1"
                style="font-size: 0.7em"
              />
            </b-tooltip>
          </span>
          <span v-else-if="post.type === 'EVERYONE'">
            <b-tooltip
              label="Everyone"
              type="is-dark"
              position="is-bottom"
            >
              <i
                class="fa-solid fa-earth-americas mx-1"
                style="font-size: 0.7em"
              />
            </b-tooltip>
          </span>
          <span v-else-if="post.type === 'PRIVATE'">
            <b-tooltip
              label="Private"
              type="is-dark"
              position="is-bottom"
            >
              <i
                class="fa-solid fa-lock mx-1"
                style="font-size: 0.7em"
              />
            </b-tooltip>
          </span>
        </div>
        <div class="m-3">
          <p>
            {{ post.content }}
          </p>
        </div>
      </div>
    </transition-group>
  </div>
</template>

<script>

export default {
  props: {
    posts: {
      type: Array,
      default: null
    }
  }
}
</script>
