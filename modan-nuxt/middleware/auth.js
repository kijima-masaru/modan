import firebase from '~/plugins/firebase'

export default function ({ route, redirect }) {
  firebase.auth().onAuthStateChanged((user) => {
    // 未ログインの場合の制御
    if (!user) {
      if (route.path !== '/' && route.path !== '/login' && route.path !== '/register' && route.path !== '/confirm') {
        redirect('/login')
      }
    }
    // ログイン済みの場合の制御
    else {
      if (route.path === '/login' || route.path === '/register' || route.path === '/confirm') {
        redirect('/index')
      }
    }
  })
}
