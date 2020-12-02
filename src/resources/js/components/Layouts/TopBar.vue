<template>
<div class="topBar px-2 w-100 border-bottom text-center text-xl-left">
  <img
    v-if="profile"
    v-on:click="sideMenu"
    :src="profile.image"
    class="Active d-inline-block d-md-none rounded-circle float-left p-1"
    >
  <span
    v-else
    v-on:click="sideMenu"
    class="Active d-inline-block d-md-none rounded-circle float-left"
  >
    <i class="fas fa-bars"></i>
  </span>
  <span class="title ml-n5 m-md-0">{{ appname }}</span>
</div>
</template>

<script>
export default {
  data: function () {
    return {
      appname: null,
      width: window.innerWidth,
    }
  },
  methods: {
    Active() {
      let sideMenu = document.getElementById('sideMenu')
      let unActive = document.getElementById('unActive')
      sideMenu.classList.add('fixed', 'dark:bg-gray-800', 'light:bg')
      sideMenu.classList.remove('d-none', 'border-right')
      unActive.insertAdjacentHTML('beforeend', '<div id="grayOut"></div>')
    },
    sideMenu() {
      this.Active()
    },
    unActive() {
      sideMenu.classList.remove('fixed', 'dark:bg-gray-800', 'light:bg')
      sideMenu.classList.add('d-none', 'border-right')
      let grayOut = document.getElementById('grayOut')
      if (grayOut) {
        grayOut.remove()
      }
    },
    handleResize() {
      this.width = window.innerWidth
      if (this.width > 754) {
        this.unActive()
      }
    }
  },
  mounted() {
    let aTag = document.getElementsByClassName('link');
      for(var i = 0; i < aTag.length; i++) {
      aTag[i].addEventListener("click", event => { this.unActive() })
      unActive.addEventListener("click", event => { this.unActive() })
    }
    this.appname = process.env.MIX_APP_NAME
    window.addEventListener('resize', this.handleResize)
  },
  beforeDestroy() {
    window.removeEventListener('resize', this.handleResize)
  },
  computed: {
    isLogin() {
      return this.$store.getters['auth/check']
    },
    user() {
      return this.$store.getters['auth/user']
    },
    profile() {
      return this.$store.getters['profile/profile'][0]
    }
  },
}
</script>
