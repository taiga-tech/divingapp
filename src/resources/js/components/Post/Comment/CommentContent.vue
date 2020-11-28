<template>
<div class="d-flex justify-content-between border-bottom p-2">
<div class="d-flex">
    <div class="mr-2">
      <img src="/default.png" class="rounded-circle border text-center" style="width: 40px; height: 40px">
    </div>
    <div>
      <div class="d-flex">
        <p class="mr-1">profilename</p>
        <p>@username</p>
      </div>
      <div class="textArea mt-1">{{ comment }}</div>
    </div>
  </div>
  <div>
    <i class="fas fa-ellipsis-h"></i>
  </div>
</div>
</template>

<script>
export default {
  props: {
    comment: Object,
  },
}
</script>
