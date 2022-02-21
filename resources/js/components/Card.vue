<template>
  <div class="item-card">
    <img :src="item.poster == 'N/A' ? noImage : item.poster" class="img img-responsive" />

    <div class="item-title p-2">{{ item.title }}</div>
    <div class="item-icons">
      <span class="badge bg-light text-dark fs-6 m-1">{{ item.type }}</span>
      <span class="badge bg-light text-dark fs-6">{{ item.year }}</span>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    item: {
      type: Object,
      require: true,
    },
  },
  data() {
    return {
      noImage: "/images/no_image.png",
    };
  },
};
</script>
<style></style>
