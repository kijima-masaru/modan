import firebase from '~/plugins/firebase'

export default function ({ route, redirect }) {
  firebase.auth().onAuthStateChanged((user) => {
    if (user && route.path === '/') {
      // ログイン済みで、index.vueへのアクセスの場合
      redirect('/posts_id')
    } else if (!user && route.path !== '/' && route.path !== '/login' && route.path !== '/register' && route.path !== '/confirm') {
      // 未ログインで、index.vue, login.vue, register.vue, confirm.vue以外へのアクセスの場合
      redirect('/')
    }
  })
}

