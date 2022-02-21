<template>
  <div class="container mt-5 mb-3">
    <div class="row">
      <div class="d-flex col mb-3 justify-content-end">
        <Button
          v-for="(param, index) in params"
          :key="index"
          :label="param.label"
          @click="storeItems(param.link)"
        ></Button>
      </div>
    </div>
    <div v-if="isSaveLoading" class="row">
      <div class="col justify-content-center text-center">
        <span
          class="spinner-border spinner-border-sm"
          role="status"
          aria-hidden="true"
        ></span>
        Updating...
      </div>
    </div>
    <div v-if="!isItemLoading" class="row">
      <div v-for="(item, index) in items" :key="index" class="col-md-4">
        <Card :item="item"></Card>
      </div>
    </div>
    <div v-else class="row" style="height: 100vh">
      <div class="col justify-content-center">
        <div class="text-center">
          <div class="spinner-border" style="width: 3rem; height: 3rem" role="status">
            <span class="visually-hidden">Loading...</span>
          </div>
        </div>
      </div>
    </div>
    <div v-if="items.length == 0 && !isSaveLoading" class="row" style="height: 100vh">
      <div class="col justify-content-center">
        <div class="text-center">
          <span class="fb-6">No Data</span>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { computed, onMounted, reactive, ref, watchEffect } from "vue";
import { useStore } from "vuex";
import useAsyncAction from "~/hooks/useAsyncAction";

export default {
  components: {},

  setup() {
    const store = useStore();
    const loading = ref(false);
    const params = reactive([
      { id: 0, label: "Matrix", link: "s=Matrix&apikey=720c3666" },
      { id: 1, label: "Matrix Reloaded", link: "s=Matrix%20Reloaded&apikey=720c3666" },
      {
        id: 2,
        label: "Matrix Revolutions",
        link: "s=Matrix%20Revolutions&apikey=720c3666",
      },
    ]);
    const { callAction: fetchItemList, isLoading: isItemLoading } = useAsyncAction(
      "item/fetchItems"
    );
    const { callAction: saveItems, isLoading: isSaveLoading } = useAsyncAction(
      "item/saveItems"
    );

    const items = computed(() => {
      return store.state.item.items;
    });

    const storeItems = async (param) => {
      saveItems({ param: param }, "Error save items");
    };

    onMounted(() => {
      fetchItemList({}, "Error fetch Items");
    });

    return {
      loading,
      isItemLoading,
      isSaveLoading,
      params,
      fetchItemList,
      saveItems,
      items,
      storeItems,
    };
  },
};
</script>
<style></style>
