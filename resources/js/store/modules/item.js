import axios from "~/axios";
import * as types from "../mutation-types";
import { mapKeys, camelCase, findLastIndex } from "lodash";

export const state = {
  items: [],
};

export const getters = {
  items: state => state.items,
};

export const mutations = {
    
    [types.FETCH_ITEMS](state, { items }) {
        state.items = items;
    },

    [types.UPDATE_ITEMS](state, { items }) {
        items.forEach(item => {
            const index = state.items.findIndex(e => e.imdbId === item.imdbId);
            if (index !== -1) {
                state.items[index] = item;
            }else {
                const lastIndex = findLastIndex(state.items);
                state.items[lastIndex + 1] = item
            }
        });    
    },
};

export const actions = {
  async fetchItems({ commit }, {}) {
    try {
      const response = await axios.get(`item`);

      const items = response.data?.data.map(item => ({
        ...mapKeys(item, (_, key) => camelCase(key))
      }));
      console.log(items)

      commit(types.FETCH_ITEMS, { items });

    } catch (e) {
      console.log("error FETCH_ITEMS", e);
    }
  },
  async saveItems({commit}, { param }) {
    try {
      const response = await axios.post(`item`, {
        param: param,
      });

      const items = response.data?.data.map(item => ({
        ...mapKeys(item, (_, key) => camelCase(key))
      }));

      commit(types.UPDATE_ITEMS, { items });
    } catch (e) {
      console.log("error UPDATE_ITEMS", e);
      return Promise.reject(e);
    }
  }
  
};

export default {
  namespaced: true,
  name: "item",
  state,
  getters,
  actions,
  mutations
};
