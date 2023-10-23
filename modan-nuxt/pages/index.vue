<template>
  <div id="post-page">
    <SideNav />
    <div class="content-area">
      <h1>ホーム</h1>
      <Message
        v-for="post in posts"
        :key="post.id"
        :id="post.id"
        :username="post.username"
        :content="post.content"
        @postDeleted="removePost"
      />
    </div>
  </div>
</template>

<script>
import Message from '~/components/Message.vue'

export default {
  components: {
    Message
  },
  data() {
    return {
      posts: []
    };
  },
  async asyncData({ $axios }) {
    const response = await $axios.get('http://localhost/api/all-posts');
    return {
      posts: response.data
    };
  },
  methods: {
    removePost(postId) {
      this.posts = this.posts.filter(post => post.id !== postId);
    }
  }
}
</script>

<style scoped>
#post-page {
  display: flex;
}

.content-area {
  flex: 1;
  background-color: #34495e;
  padding: 20px;
  color: white;
}
</style>