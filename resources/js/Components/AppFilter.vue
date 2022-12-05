<template>
  <div class="bg-[#F6F3FA] rounded-[6px] border">
    <div class="flex justify-between items-center p-7 xxl:p-5 xl:p-4">
      <span class="text-[#1E1D2D] text-lg xxl:text-base xl:text-sm">Фильтры</span>
      <button class="text-[#6435A5] text-sm xxl:text-xs xl:text-[10px]">Сбросить</button>
    </div>
    <div class="h-[1px] w-full bg-[#E5DFEE]"></div>
    <div class="p-7 xxl:p-5 xl:p-4">
      <div class="flex flex-col gap-5 xxl:gap-4 xl:gap-3">
        <div class="multi__select border border-solid border-[#E5DFEE] rounded-[6px] p-5 xx:p-4 xl:p-3">
          <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]">Тип</span>
          <Multiselect
            v-model="valueSelectType"
            :options="optionsSelectType"
            mode="tags"
            placeholder="Выбрать тип"
            :close-on-select="true"
          />
        </div>
        <div class="ones__select border border-solid border-[#E5DFEE] rounded-[6px] p-5 xx:p-4 xl:p-3">
          <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]">Город</span>
          <Multiselect
            v-model="valueSelectCity"
            :options="optionsSelectCity"
            placeholder="Выбрать город"
            :close-on-select="true"
          />
        </div>
        <div class="ones__select border border-solid border-[#E5DFEE] rounded-[6px] p-5 xx:p-4 xl:p-3">
          <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]">Район</span>
          <Multiselect
            v-model="valueSelectArea"
            :options="optionsSelectArea"
            placeholder="Выбрать район"
            :close-on-select="true"
          />
        </div>
        <div class="ones__select border border-solid border-[#E5DFEE] rounded-[6px] p-5 xx:p-4 xl:p-3">
          <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]">Цена</span>
          <div class="flex gap-2">
            <div class="flex items-center gap-1">
              <label class="text-lg xxl:text-base xl:text-sm" for="cost_from">от</label>
              <input class="text-lg xxl:text-base xl:text-sm border__bottom p-0 w-full bg-[#F6F3FA] border-transparent focus:ring-0" type="number" id="cost_from">
            </div>
            <div class="flex items-center gap-1">
              <label class="text-lg xxl:text-base xl:text-sm" for="cost_before">до</label>
              <input class="text-lg xxl:text-base xl:text-sm border__bottom p-0 w-full bg-[#F6F3FA] border-transparent focus:ring-0" type="number" id="cost_before">
            </div>
          </div>
        </div>
        <div class="ones__select border border-solid border-[#E5DFEE] rounded-[6px] p-5 xx:p-4 xl:p-3">
          <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]">Срок сдачи</span>
          <Multiselect
            v-model="valueSelectTerm"
            :options="optionsSelectTerm"
            placeholder="Срок сдачи"
            :close-on-select="true"
          />
        </div>
        <div class="ones__select border border-solid border-[#E5DFEE] rounded-[6px] p-5 xx:p-4 xl:p-3">
          <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]">Площадь</span>
          <div class="flex gap-2">
            <div class="flex items-center gap-1">
              <label class="text-lg xxl:text-base xl:text-sm" for="cost_from">от</label>
              <input class="text-lg xxl:text-base xl:text-sm border__bottom p-0 w-full bg-[#F6F3FA] border-transparent focus:ring-0" type="number" id="cost_from">
            </div>
            <div class="flex items-center gap-1">
              <label class="text-lg xxl:text-base xl:text-sm" for="cost_before">до</label>
              <input class="text-lg xxl:text-base xl:text-sm border__bottom p-0 w-full bg-[#F6F3FA] border-transparent focus:ring-0" type="number" id="cost_before">
            </div>
          </div>
        </div>
        <div class="ones__select border border-solid border-[#E5DFEE] rounded-[6px] p-5 xx:p-4 xl:p-3">
          <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]">Застройщик</span>
          <Multiselect
            v-model="valueSelectDev"
            :options="optionsSelectDev"
            placeholder="Застройщик"
            :close-on-select="true"
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Multiselect from '@vueform/multiselect'

export default {
  data () {
    return {
      valueSelectType: null,
      optionsSelectType: [
        'Эконом 1',
        'Эконом 2',
        'Элит 1',
        'Элит 2',
      ],
      valueSelectCity: null,
      optionsSelectCity: [
        'Москва',
        'Сочи',
      ],
      valueSelectArea: null,
      optionsSelectArea: [
        'Центральный',
        'Юнжный',
        'Западный',
      ],
      valueSelectTerm: null,
      optionsSelectTerm: [
        'Сдан',
        'Не сдан',
      ],
      valueSelectDev: null,
      optionsSelectDev: [
        'Группа Аквилон',
        'Группа Акв',
      ]
    }
  },
  components: {
    Multiselect
  }
}
</script>

<style src="@vueform/multiselect/themes/default.css"></style>

<style scoped>

</style>
