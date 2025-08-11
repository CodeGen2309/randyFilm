<script setup></script>



<template>
  <div class="fadingRect"></div>
</template>




<style scoped>
.fadingRect {
  height: 150px;
  aspect-ratio: 1;
  padding: 15px;
  border-radius: 50px;
  box-sizing: border-box;
  position: relative;
  mask: conic-gradient(#000 0 0) content-box exclude,conic-gradient(#000 0 0);
  filter: blur(12px);
}

.fadingRect:before {
  content: "";
  position: absolute;
  inset: 0;
  background: repeating-conic-gradient(#C02942 0 1%,#ff1c42,#0000 30% 50%);
  animation: l3 1.5s linear infinite;
}

@keyframes l3 {
  to {rotate: 0.5turn}
}
</style>