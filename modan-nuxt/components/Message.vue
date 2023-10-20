<template>
  <div class="message">
    <div class="header">
      <div class="title">{{ username }}</div>
      <div class="icons">
        <span>❤️ {{ likes }}</span>
        <span>✖️</span>
      </div>
    </div>
    <div class="content">{{ content }}</div>
  </div>
</template>

<script>
export default {
  name: 'Message',
  props: {
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
