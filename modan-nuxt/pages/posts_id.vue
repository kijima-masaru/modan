<template>
  <div id="post-page">
    <SideNav />
    <div class="content-area">
      <h2>ホーム</h2>
      <Message 
        v-for="post in posts" 
        :key="post.id" 
        :username="post.username" 
        :content="post.content" 
        :likes="post.likes"
      />
    </div>
  </div>
</template>

<script>
import SideNav from '@/components/SideNav.vue'
import Message from '@/components/Message.vue'

export default {
  components: {
    SideNav,
    Message
  },
  data() {
    return {
      posts: [
        {
          id: 1,
          username: "test1",
          content: "test",
          likes: 10
        }
        // 他の投稿データもここに
      ]
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