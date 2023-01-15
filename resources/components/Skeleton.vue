<template>
  <section>
    <article
      v-for="i in media"
      :key="i"
      class="media"
    >
      <figure class="media-left">
        <p class="image is-64x64">
          <b-skeleton
            circle
            width="64px"
            height="64px"
          />
        </p>
      </figure>
      <div class="media-content">
        <div class="content">
          <p>
            <b-skeleton active />
            <b-skeleton height="80px" />
          </p>
        </div>
        <nav class="level is-mobile">
          <div class="level-left">
            <a class="level-item">
              <span class="icon is-small">
                <b-skeleton />
              </span>
            </a>
            <a class="level-item">
              <span class="icon is-small">
                <b-skeleton />
              </span>
            </a>
          </div>
        </nav>
      </div>
    </article>
  </section>
</template>

<script>
export default {
  data () {
    return {
      media: 3
    }
  }
}
</script>
