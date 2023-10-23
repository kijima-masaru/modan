<template>
  <div class="message">
    <div class="header">
      <div class="title">{{ username }}</div>
      <div class="icons">
        <span>❤️ {{ likes }}</span>
        <span @click="deletePost">✖️</span>
      </div>
    </div>
    <div class="content">{{ content }}</div>
  </div>
</template>

<script>
export default {
  name: 'Message',
  props: {
  id: {
      type: Number,
      required: true
    },
    username: {
      type: String,
      required: true
    },
    content: {
      type: String,
      required: true
    },
    likes: {
      type: Number,
      default: 0
    }
  },
  methods: {
    async deletePost() {
      try {
        const response = await this.$axios.delete(`http://localhost/api/post/${this.id}`);
        if (response.data.message) {
          this.$emit('postDeleted', this.id); // 削除後に親コンポーネントに通知
          alert(response.data.message);
        }
      } catch (error) {
        console.error(error);
        alert('An error occurred while deleting the post.');
      }
    }
  }
}
</script>

<style scoped>
.message {
  background-color: #2c3e50;
  padding: 15px;
  margin-bottom: 20px;
  border-radius: 5px;
}

.header {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.icons span {
  margin-left: 10px;
  cursor: pointer;
}
</style>