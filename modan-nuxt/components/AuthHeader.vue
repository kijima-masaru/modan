<template>
  <div class="auth-header">
    <div class="logo">SHARE</div>
    <div class="auth-options">
      <div @click="redirectToLogin">ログイン</div>
      <div @click="redirectToRegister">新規登録</div>
    </div>
  </div>
</template>

<script>
export default {
  methods: {
    redirectToLogin() {
      this.$router.push('/login');
    },
    redirectToRegister() {
      this.$router.push('/register');
    }
  }
}
</script>

<style scoped>
.auth-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 10px 20px;  /* Increased horizontal padding for spacing */
  background-color: #ffffff;  /* Assuming a white background from the image */
  box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);  /* Adding a subtle shadow for depth */
}

.logo {
  font-size: 24px;
  font-weight: bold;
  color: #333;
}

.auth-options {
  display: flex;  /* Making sure the child divs are in a row */
}

.auth-options > div {
  margin-left: 20px;
  cursor: pointer;
  padding: 5px 15px;  /* 横のパディングを増やす */
  font-size: 16px;  /* フォントサイズを大きくする */
  border: 1px solid #333;  /* ボーダーを追加する */
  border-radius: 5px;  /* 角を丸くする */
}

.auth-options > div:hover {
  background-color: #f2f2f2;
  color: #333;  /* ホバー時のフォントカラー */
}

</style>

