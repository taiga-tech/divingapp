const state = {
  profile: null
}

const getters = {
  profile: state => state.profile ? state.profile : '',
}

const mutations = {
  setProfile (state, profile) {
    state.profile = profile;
  },
  changeProfile (state, profile) {
    Vue.set(state.profile, 0, profile)
  }
}

const actions = {
  async create (context, data) {
    const response = await axios.post('/api/profiles', data);
    context.commit('changeProfile', response.data);
  },
  async update (context, { profileId, data }) {
    const response = await axios.post(`/api/profiles/${profileId}`, data, {
      headers: { 'X-HTTP-Method-Override': 'PUT' }
    });
    context.commit('changeProfile', response.data);
  },
  async currentProfile (context, id) {
    const response = await axios.get(`/api/profiles/${id}`);
    const profile = response.data || null;
    context.commit('setProfile', profile);
  },
  async logoutProfile (context) {
    context.commit('setProfile', null)
  }
}

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
}
