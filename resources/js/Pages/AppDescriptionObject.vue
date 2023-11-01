<template>
  <app-header
    :user="user"
    @update-block-client="updateBlockClient"
    :language="language"
    @selectLanguage="choseLanguage"
  />
  <app-modal-album
    v-if="album"
    :image="house.images"
    :house="house"
    @close-album="album = false"
    :language="language"
  />

  <!--Модалка для отправить клиенту-->
  <app-moadal-add-client
    v-if="addClient"
    :house="house"
    :user="user"
    :language="language"
    @close-addClient="closeAddClient"
  />

  <app-add-selections
    v-if="openAddSelection"
    @open-i-create-selections="openCreateSel"
    @close-add-selection="openAddSelection = false"
    :compilation="compilation"
    :city_array="city_array"
    :area_array="area_array"
    :house="house"
    :language="language"
  />
  <app-immovables-create-selection
    v-if="openCreateSelection"
    @close-i-create-selection="closeCreateSel"
    @updateCompilation="updateCompilation"
    :house="house"
    :user="user"
    :language="language"
  />
  <app-all-news
    v-if="openAllNews"
    @close-all-news="openAllNews = false"
    :language="language"
    :house="house"
  />
  <app-chess
    v-if="chess"
    :house="house"
    @close-chess="closeChess"
    @open-cheme="openScheme"
    :language="language"
  />
  <app-chess-scheme
    v-if="openCheme"
    :flat="selectFlat"
    @closeChess="openCheme = false"
    :language="language"
  />
  <main v-if="!chess">
    <div class="_container flex flex-col">
      <div
        class="decription__head h-20 xxl:h-16 xl:h-12 lg:h-fit rounded-[12px] my-7 xxl:my-5 xl:my-4"
      >
        <div class="flex lg:flex-col items-center justify-between">
          <div class="flex flex-col p-4 xxl:p-3 xl:p-2">
            <div
              class="relative flex items-center lg:justify-center gap-5 xxl:gap-4 xl:gap-3"
            >
              <span
                class="font-semibold text-xl xxl:text-lg xl:text-sm lg:text-[19px]"
                >{{ house.title }}</span
              >
              <div
                class="flex whitespace-nowrap items-center gap-2 xxl:gap-1.5 xl:gap-1 text-[14px] xxl:text-[12px] xl:text-[10px] lg:text-[14px]"
              >
                <span
                  class="flex items-center justify-center uppercase border border-solid border-[#30CB49] h-fit text-[#30CB49] leading-none font-medium rounded-[3px] px-3 xxl:px-2 xl:px-1.5 h-[25px] xxl:h-[20px] xl:h-[16px]"
                  v-if="house.created && !Number.isInteger(+house.created[0])"
                  >{{ language.rielt_1[10] }}</span
                >
                <span
                  class="flex items-center justify-center uppercase border border-solid border-[#E84680] h-fit text-[#E84680] leading-none font-medium rounded-[3px] px-3 xxl:px-2 xl:px-1.5 h-[25px] xxl:h-[20px] xl:h-[16px]"
                  v-else-if="house.created"
                  >{{ house.created }}</span
                >
                <span
                  class="flex items-center justify-center text-white font-semibold bg-[#FA8D50] leading-none rounded-[3px] px-3 xxl:px-2 xl:px-1.5 h-[25px] xxl:h-[20px] xl:h-[16px]"
                  v-if="house.promotion"
                  >{{ language.rielt_1[52] }}</span
                >
                <span
                  class="flex items-center justify-center text-white font-semibold bg-[#E84680] leading-none rounded-[3px] px-3 xxl:px-2 xl:px-1.5 h-[25px] xxl:h-[20px] xl:h-[16px]"
                  v-if="
                    Math.ceil(
                      Math.abs(
                        new Date().getTime() -
                          new Date(house.created_at).getTime()
                      ) /
                        (1000 * 3600 * 24)
                    ) <= 30
                  "
                  >{{ language.rielt_1[51] }}</span
                >
                <span
                  class="flex items-center justify-center text-white font-semibold bg-[#E84646] leading-none rounded-[3px] px-3 xxl:px-2 xl:px-1.5 h-[25px] xxl:h-[20px] xl:h-[16px]"
                  v-if="house.visible >= 50"
                  >{{ language.rielt_1[53] }}</span
                >
              </div>
              <!--Всплывашка-->
              <div class="hitn-icon">
                <img src="../../../public/images/new/question.png" alt="" srcset="">
              </div>
              <div class="hitn-text">
                 {{ language.subscription[79] }}
              </div>
            </div>
            <span
              class="text-[#8A8996] text-center text-sm xxl:text-xs xl:text-[10px] lg:text-[14px]"
              >{{
                selectLanguage === 0
                  ? city_name.title
                  : selectLanguage === 1
                  ? city_name.title_en
                  : city_name.title_tr
              }},
              {{
                area_name !== undefined
                  ? selectLanguage === 0
                    ? area_name.title
                    : selectLanguage === 1
                    ? area_name.title_en
                    : area_name.title_tr
                  : ""
              }}</span
            >
          </div>

          <div
            class="flex lg:flex-col lg:items-center h-20 xxl:h-16 xl:h-12 lg:h-fit"
          >
            <div
              class="border__right lg:border-0 flex items-center lg:flex-col gap-5 xxl:gap-4 xl:gap-3 p-4 xxl:p-3 xl:p-2"
            >
              <div class="flex items-center gap-1.5 xxl:gap-1 xl:gap-0.5">
                <img
                  src="../../assets/svg/reload_icon.svg"
                  class="h-4 xx:h-3.5 xl:h-3 lg:h-4"
                  alt="reload"
                />
                <span
                  class="text-sm xxl:text-xs xl:text-[10px] lg:text-[15px]"
                  >{{ getDate(house.updated_at) }}</span
                >
              </div>
              <div
                @click="map = !map"
                class="button__map text-[#6435A5] flex items-center justify-center cursor-pointer bg-[#F6F3FA] gap-2 xxl:gap-1.5 xl:gap-1 h-10 xxl:h-8 xl:h-6 lg:h-8 px-4 xxl:px-3 xl:px-2.5 rounded-[4px]"
              >
                <svg
                  width="24"
                  height="24"
                  class="h-6 xxl:h-5 xl:h-4 lg:h-5"
                  viewBox="0 0 24 24"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <g clip-path="url(#clip0_134_1964)">
                    <path
                      d="M18.364 17.364L12 23.728L5.636 17.364C4.37734 16.1054 3.52019 14.5017 3.17293 12.7559C2.82567 11.0101 3.00391 9.20047 3.6851 7.55595C4.36629 5.91142 5.51984 4.50582 6.99988 3.51689C8.47992 2.52796 10.22 2.00012 12 2.00012C13.78 2.00012 15.5201 2.52796 17.0001 3.51689C18.4802 4.50582 19.6337 5.91142 20.3149 7.55595C20.9961 9.20047 21.1743 11.0101 20.8271 12.7559C20.4798 14.5017 19.6227 16.1054 18.364 17.364ZM12 15C13.0609 15 14.0783 14.5786 14.8284 13.8285C15.5786 13.0783 16 12.0609 16 11C16 9.93918 15.5786 8.92176 14.8284 8.17162C14.0783 7.42147 13.0609 7.00004 12 7.00004C10.9391 7.00004 9.92172 7.42147 9.17158 8.17162C8.42143 8.92176 8 9.93918 8 11C8 12.0609 8.42143 13.0783 9.17158 13.8285C9.92172 14.5786 10.9391 15 12 15ZM12 13C11.4696 13 10.9609 12.7893 10.5858 12.4143C10.2107 12.0392 10 11.5305 10 11C10 10.4696 10.2107 9.9609 10.5858 9.58583C10.9609 9.21076 11.4696 9.00004 12 9.00004C12.5304 9.00004 13.0391 9.21076 13.4142 9.58583C13.7893 9.9609 14 10.4696 14 11C14 11.5305 13.7893 12.0392 13.4142 12.4143C13.0391 12.7893 12.5304 13 12 13Z"
                      fill="#6435A5"
                    />
                  </g>
                  <defs>
                    <clipPath id="clip0_134_1964">
                      <rect width="24" height="24" fill="white" />
                    </clipPath>
                  </defs>
                </svg>
                <span
                  class="text-sm xxl:text-xs xl:text-[10px] lg:text-[15px] leading-none"
                  >{{
                    map ? language.menu_zastr_1[11] : language.rielt_1[6]
                  }}</span
                >
              </div>
            </div>

            <div
              v-if="user.role === 0"
              class="border__right lg:border-0 flex items-center gap-3 xxl:gap-2 xl:gap-1.5 p-4 xxl:p-3 xl:p-2"
            >
              <button
                @click="openAddSelection = true"
                class="relative plus__hover flex items-center justify-center h-10 xxl:h-8 xl:h-6 lg:h-8 w-10 xxl:w-8 xl:w-6 lg:w-8 bg-[#F6F3FA] rounded-[3px]"
              >
                <img
                  src="../../assets/svg/plus_icon_grey.svg"
                  class="h-6 xxl:h-5 xl:h-4 lg:h-5"
                  alt="plus"
                />
                <div
                  class="seek absolute opacity-0 overflow-hidden pointer-events-none px-3 xxl:px-2.5 xl:px-2 bg-white border border-solid border-[#E5DFEE] rounded-[3px] z-10 text-base xxl:text-sm xl:text-xs top-[140%] -left-1/2 whitespace-nowrap transition-all"
                >
                  {{ language.rielt_1[14] }}
                </div>
              </button>
              <button
                v-if="!flagFavorite"
                @click="addToFavorite"
                class="relative heart__hover flex items-center justify-center h-10 xxl:h-8 xl:h-6 lg:h-8 w-10 xxl:w-8 xl:w-6 lg:w-8 bg-[#F6F3FA] rounded-[3px]"
              >
                <img
                  src="../../assets/svg/heart_icon_grey.svg"
                  class="h-6 xxl:h-5 xl:h-4 lg:h-5"
                  alt="Сердце"
                />
                <div
                  class="seek absolute opacity-0 overflow-hidden pointer-events-none px-3 xxl:px-2.5 xl:px-2 bg-white border border-solid border-[#E5DFEE] rounded-[3px] z-10 text-base xxl:text-sm xl:text-xs top-[140%] -left-1/2 whitespace-nowrap transition-all"
                >
                  {{ language.rielt_1[16] }}
                </div>
              </button>
              <button
                v-if="flagFavorite"
                @click="removeToFavorite"
                class="relative heart__hover flex items-center justify-center h-10 xxl:h-8 xl:h-6 lg:h-8 w-10 xxl:w-8 xl:w-6 lg:w-8 bg-[#F6F3FA] rounded-[3px]"
              >
                <img
                  src="../../assets/svg/heart_icon_pink.svg"
                  class="h-6 xxl:h-5 xl:h-4 lg:h-5"
                  alt="Сердце"
                />
                <div
                  class="seek absolute opacity-0 overflow-hidden pointer-events-none px-3 xxl:px-2.5 xl:px-2 bg-white border border-solid border-[#E5DFEE] rounded-[3px] z-10 text-base xxl:text-sm xl:text-xs top-[140%] -left-1/2 whitespace-nowrap transition-all"
                >
                  {{ language.rielt_1[8] }}
                </div>
              </button>

              <div
                class="send_client flex items-center p-4 xxl:p-3 xl:p-2"
                @click="addClient = true"
              >
                <button
                  class="login__btn--bg bg-[#E84680] px-4 xxl:px-4 xl:px-2.5 rounded-[3px] h-10 xxl:h-8 xl:h-6 font-semibold text-white text-base xxl:text-[13px] xl:text-[11px] lg:text-[15px] leading-none"
                >
                  {{ language.btn_send[0] }}
                </button>
              </div>
            </div>

            <div
              class="flex items-center p-4 xxl:p-3 xl:p-2"
              @click="chess = true"
              v-if="house.flats.length > 0"
            >
              <button
                class="login__btn--bg bg-[#E84680] px-4 xxl:px-4 xl:px-2.5 rounded-[3px] h-10 xxl:h-8 xl:h-6 font-semibold text-white text-base xxl:text-[13px] xl:text-[11px] lg:text-[15px] leading-none"
              >
                {{ language.shahm[0] }}
              </button>
            </div>
          </div>
        </div>
      </div>
      <app-map
        @open-add-selections="openAddSelection = true"
        v-if="map"
        :houses_array="markers"
        :city="city"
        :houses="house"
        :type="3"
        :state="false"
      />
      <div class="grid__68-30 justify-between" v-if="!map">
        <div class="w-full flex flex-col">
          <swiper
            :navigation="true"
            :modules="modules"
            :loop="true"
            class="mySwiper w-full"
          >
            <swiper-slide
              class="h-full flex justify-center"
              v-if="house.images.length === 0"
            >
              <img
                @click="album = true"
                class="h-full w-full object-cover"
                src="../../assets/no-img-house.jpg"
                alt=""
              />
            </swiper-slide>
            <swiper-slide
              class="h-full flex justify-center cursor-pointer"
              v-for="item in mainPhotos"
            >
              <img
                @click="album = true"
                class="h-full w-full"
                :src="item.isResize === 1 ? imageServiceUrl + item.name : item.name"
                alt=""
              />
            </swiper-slide>
          </swiper>
          <div
            class="border border-solid border-[#E5DFEE] h-[100px] xxl:h-[80px] xl:h-[60px] sm:h-fit flex items-center sm:flex-col justify-evenly rounded-[12px] mt-7 xxl:mt-5 xl:mt-4 mb-16 xxl:mb-12 xl:mb-10"
          >
            <div class="flex flex-col justify-center sm:p-2">
              <span
                class="text-[18px] xxl:text-[15px] xl:text-[13px] lg:text-[16px] text-center leading-none"
                >{{
                  house.info.type === "Новостройка"
                    ? language.rielt_1[0]
                    : language.rielt_1[1]
                }}</span
              >
              <span
                class="text-center text-[#8A8996] text-[13px] xxl:text-[11px] xl:text-[9px] lg:text-[13px]"
                >{{ language.rielt_1[12] }}</span
              >
            </div>
            <div class="h-full w-[1px] sm:h-[1px] sm:w-full bg-[#E5DFEE]"></div>
            <div class="flex flex-col justify-center sm:p-2">
              <span
                class="text-[18px] xxl:text-[15px] xl:text-[13px] lg:text-[16px] text-center leading-none"
                >{{ countFlats }}</span
              >
              <span
                class="text-center text-[#8A8996] text-[13px] xxl:text-[11px] xl:text-[9px] lg:text-[13px]"
                >{{ language.dob_kv_1[17] }}</span
              >
            </div>
            <div class="h-full w-[1px] sm:h-[1px] sm:w-full bg-[#E5DFEE]"></div>
            <div class="flex flex-col justify-center sm:p-2">
              <span
                class="text-[18px] xxl:text-[15px] xl:text-[13px] lg:text-[16px] text-center leading-none"
                >{{
                  Number.isInteger(minPriceForM)
                    ? minPriceForM.toLocaleString("ru")
                    : "-"
                }}
                €</span
              >
              <span
                class="text-center text-[#8A8996] text-[13px] xxl:text-[11px] xl:text-[9px] lg:text-[13px]"
                >{{ language.rielt_1[56] }} м²</span
              >
            </div>
            <div class="h-full w-[1px] sm:h-[1px] sm:w-full bg-[#E5DFEE]"></div>
            <div class="flex flex-col justify-center sm:p-2">
              <span
                class="text-[18px] xxl:text-[15px] xl:text-[13px] lg:text-[16px] text-center leading-none"
                >{{
                  Number.isInteger(minPriceFlat)
                    ? minPriceFlat.toLocaleString("ru")
                    : "-"
                }}
                €</span
              >
              <span
                class="text-center text-[#8A8996] text-[13px] xxl:text-[11px] xl:text-[9px] lg:text-[13px]"
                >{{ language.rielt_1[57] }}</span
              >
            </div>
            <div class="h-full w-[1px] sm:h-[1px] sm:w-full bg-[#E5DFEE]"></div>
            <div class="flex flex-col justify-center sm:p-2">
              <span
                class="text-[18px] xxl:text-[15px] xl:text-[13px] lg:text-[16px] text-center leading-none"
                >{{ Number.isInteger(minSquareFlat) ? minSquareFlat : "-" }} -
                {{
                  Number.isInteger(maxSquareFlat) ? maxSquareFlat : "-"
                }}</span
              >
              <span
                class="text-center text-[#8A8996] text-[13px] xxl:text-[11px] xl:text-[9px] lg:text-[13px]"
                >{{ language.rielt_1[22] }}, м²</span
              >
            </div>
          </div>
          <div
            class="flex flex-col pb-14 xxl:pb-10 xl:pb-8"
            v-if="house.description"
          >
            <span
              class="uppercase font-medium text-[18px] xxl:text-[15px] xl:text-[13px] lg:text-[16px] pb-5 xxl:pb-4 xl:pb-3 leading-none"
              >{{ language.form_dob_ob[0] }}</span
            >
            <p
              class="text-[#8A8996] text-base xxl:text-sm xl:text-xs pb-6 xxl:pb-5 xl:pb-4"
              v-if="fullDescription || house.description.length < 300"
              v-html="
                selectLanguage === 0
                  ? house.description
                  : selectLanguage === 1
                  ? house.description_en
                  : house.description_tr
              "
            ></p>
            <p
              class="text-[#8A8996] text-base xxl:text-sm xl:text-xs pb-6 xxl:pb-5 xl:pb-4"
              v-else
              v-html="
                selectLanguage === 0
                  ? house.description !== null
                    ? house.description.slice(0, 300)
                    : house.description
                  : selectLanguage === 1
                  ? house.description_en !== null
                    ? house.description_en.slice(0, 300)
                    : house.description_en
                  : house.description_tr !== null
                  ? house.description_tr.slice(0, 300)
                  : house.description_tr + '...'
              "
            ></p>
            <button
              class="flex gap-2 xxl:gap-1.5 xl:gap-1 items-center w-fit animation__arrow"
              @click="fullDescription = !fullDescription"
              v-if="house.description.length > 300"
            >
              <span
                class="text-[#6435A5] font-medium text-sm xxl:text-xs xl:text-[10px] lg:text-[14px]"
                >{{
                  fullDescription
                    ? language.menu_zastr_1[11]
                    : language.menu_zastr_1[14]
                }}</span
              >
              <img
                src="../../assets/svg/arrow_right_purple.svg"
                class="transition-all duration-300 w-3.5 xxl:w-3 xl:wp-2.5"
                alt="Стрелочка в право"
              />
            </button>
          </div>
          <div
            class="text-[18px] xxl:text-[15px] xl:text-[13px] lg:text-[16px] pb-14 xxl:pb-10 xl:pb-8"
            v-if="arrayInfos.length > 0"
          >
            <span class="font-medium">{{ language.rielt_1[35] }}</span>
            <div
              class="flex flex-wrap gap-3 xxl:gap-2.5 xl:gap-2m pt-4 xxl:pt-3 xl:pt-2.5"
            >
              <span
                class="infrostruct__banner text-[#E84680] rounded-[12px] xl:rounded-[8px] leading-none px-5 xxl:px-4 xl:px-3 py-3 xxl:py-2 xl:py-1.5"
                v-for="item in arrayInfos"
                >{{
                  selectLanguage === 0
                    ? item.name
                    : selectLanguage === 1
                    ? item.name_en
                    : item.name_tr
                }}</span
              >
            </div>
          </div>
          <div
            class="grid grid-cols-2 lg:grid-cols-1 gap-7 xxl:gap-5 xl:gap-4 pb-14 xxl:pb-10 xl:pb-8"
          >
            <div
              class="border border-solid border-[#E5DFEE] p-7 xxl:p-5 xl:p-4 rounded-[12px]"
            >
              <span
                class="font-medium text-[18px] xxl:text-[15px] xl:text-[13px] lg:text-[16px]"
                >{{ language.rielt_1[45] }}</span
              >
              <div
                class="flex flex-col gap-5 xxl:gap-4 xl:gap-3 pt-6 xxl:pt-5 xl:pt-4"
              >
                <div
                  class="flex justify-between items-center"
                  v-for="dop in dops"
                >
                  <span
                    :class="{ disableColor: dop.active !== 1 }"
                    class="text-base xxl:text-sm xl:text-xs lg:text-[15px]"
                    >{{
                      selectLanguage === 0
                        ? dop.name
                        : selectLanguage === 1
                        ? dop.name_en
                        : dop.name_tr
                    }}</span
                  >
                  <div
                    v-if="dop.active === 1"
                    class="bg-[#30CB49] h-5 w-5 xxl:h-4 xxl:w-4 xl:h-3 xl:w-3 lg:w-4 lg:h-4 rounded-full flex items-center justify-center"
                  >
                    <img
                      src="../../assets/svg/check_icon.svg"
                      class="w-5 xxl:w-4 xl:w-3 lg:w-4"
                      alt=""
                    />
                  </div>
                  <div
                    v-else
                    class="bg-[#E84680] h-5 w-5 xxl:h-4 xxl:w-4 xl:h-3 xl:w-3 lg:w-4 lg:h-4 rounded-full flex items-center justify-center"
                  >
                    <img
                      src="../../assets/svg/exit_icon_white.svg"
                      class="w-5 xxl:w-4 xl:w-3 lg:w-4"
                      alt=""
                    />
                  </div>
                </div>
              </div>
            </div>
            <div
              class="border border-solid border-[#E5DFEE] p-7 xxl:p-5 xl:p-4 rounded-[12px]"
            >
              <span
                class="font-medium text-[18px] xxl:text-[15px] xl:text-[13px] lg:text-[16px]"
                >{{ language.rielt_1[24] }}</span
              >
              <div
                class="flex flex-col gap-5 xxl:gap-4 xl:gap-3 pt-6 xxl:pt-5 xl:pt-4"
              >
                <div
                  class="flex justify-between items-center"
                  v-if="house.info.toSea !== null"
                >
                  <span
                    class="text-[#8A8996] text-base xxl:text-sm xl:text-xs xl:text-xs lg:text-[15px]"
                    >{{ language.rielt_1[26] }}</span
                  >
                  <span class="text-base xxl:text-sm xl:text-xs lg:text-[15px]"
                    >{{ house.info.toSea }} м</span
                  >
                </div>
                <div
                  class="flex justify-between items-center"
                  v-if="house.info.toShop !== null"
                >
                  <span
                    class="text-[#8A8996] text-base xxl:text-sm xl:text-xs lg:text-[15px]"
                    >{{ language.rielt_1[28] }}</span
                  >
                  <span class="text-base xxl:text-sm xl:text-xs lg:text-[15px]"
                    >{{ house.info.toShop }} м</span
                  >
                </div>
                <div
                  class="flex justify-between items-center"
                  v-if="house.info.toChildrenSchool !== null"
                >
                  <span
                    class="text-[#8A8996] text-base xxl:text-sm xl:text-xs lg:text-[15px]"
                    >{{ language.rielt_1[29] }}</span
                  >
                  <span class="text-base xxl:text-sm xl:text-xs lg:text-[15px]"
                    >{{ house.info.toChildrenSchool }} м</span
                  >
                </div>
                <div
                  class="flex justify-between items-center"
                  v-if="house.info.toPark !== null"
                >
                  <span
                    class="text-[#8A8996] text-base xxl:text-sm xl:text-xs lg:text-[15px]"
                    >{{ language.rielt_1[33] }}</span
                  >
                  <span class="text-base xxl:text-sm xl:text-xs lg:text-[15px]"
                    >{{ house.info.toPark }} м</span
                  >
                </div>
                <div
                  class="flex justify-between items-center"
                  v-if="house.info.toBus !== null"
                >
                  <span
                    class="text-[#8A8996] text-base xxl:text-sm xl:text-xs lg:text-[15px]"
                    >{{ language.rielt_1[34] }}</span
                  >
                  <span class="text-base xxl:text-sm xl:text-xs lg:text-[15px]"
                    >{{ house.info.toBus }} м</span
                  >
                </div>
                <div
                  class="flex justify-between items-center"
                  v-if="house.info.toSchool !== null"
                >
                  <span
                    class="text-[#8A8996] text-base xxl:text-sm xl:text-xs lg:text-[15px]"
                    >{{ language.rielt_1[30] }}</span
                  >
                  <span class="text-base xxl:text-sm xl:text-xs lg:text-[15px]"
                    >{{ house.info.toSchool }} м</span
                  >
                </div>
              </div>
            </div>
          </div>
        </div>
        <app-decrition-object-sidebar
          class="w-full"
          v-if="!isWithClient"
          @open-all-news="openAllNews = true"
          :house="house"
          :language="language"
        />
      </div>
    </div>
    <div class="w-full h-[1px] bg-[#E5DFEE]"></div>
    <div class="_container" v-if="user.role !== 1">
      <app-description-object-other-j-k
        :house="house"
        :slider="slider"
        :language="language"
        :selectLanguage="selectLanguage"
        :city_name="city_array"
        :area_name="area_array"
      />
    </div>
  </main>
  <app-footer :language="language" />
</template>

<script>
import AppHeader from "../Layouts/AppHeader.vue";
import AppFooter from "../Layouts/AppFooter.vue";
import AppDecritionObjectSidebar from "../Components/AppDecritionObjectSidebar.vue";
import AppDescriptionObjectOtherJK from "../Components/AppDescriptionObjectOtherJK.vue";
import AppModalAlbum from "@/Layouts/modal/AppModalAlbum.vue";
import AppAllNews from "@/Layouts/modal/AppAllNews.vue";
import AppAddSelections from "@/Layouts/modal/AppAddSelections.vue";
import AppImmovablesCreateSelection from "@/Layouts/modal/AppImmovablesCreateSelection.vue";
import AppChess from "@/Components/AppChess.vue";
import AppChessScheme from "../Layouts/modal/AppChessScheme.vue";
import AppMoadalAddClient from "../Layouts/modal/AppMoadalAddClient.vue";

import { Swiper, SwiperSlide } from "swiper/vue";
import "swiper/css";
import "swiper/css/navigation";
import "swiper/css/pagination";
import { Navigation, Pagination } from "swiper";
import AppMap from "@/Components/AppMap.vue";

export default {
  props: [
    "house",
    "dops",
    "user",
    "slider",
    "infos",
    "compilation",
    "city_array",
    "area_array",
  ],
  data() {
    return {
      fullDescription: false,
      arrayInfos: [],
      album: false,
      openAllNews: false,
      openAddSelection: false,
      openCreateSelection: false,
      map: false,
      flagFavorite: null,
      mainPhotos: [],
      chess: false,
      isWithClient: false,
      openCheme: false,
      selectFlat: null,
      city: null,
      markers: null,
      addClient: false,
      language: {},
      selectLanguage: 0,
      city_name: {},
      area_name: {},
      imageServiceUrl: '',
    };
  },
  provide() {
    return {
      user: this.user,
    };
  },
  created() {
    this.imageServiceUrl = this.$service;
    if (this.user.lang === 0) {
      this.language = this.$ru;
      this.selectLanguage = 0;
    } else if (this.user.lang === 1) {
      this.language = this.$en;
      this.selectLanguage = 1;
    } else if (this.user.lang === 2) {
      this.language = this.$tur;
      this.selectLanguage = 2;
    }

    this.city_name = this.city_array.find(
      (item) => item.title === this.house.city
    );
    this.area_name = this.area_array.find(
      (item) => item.title === this.house.area
    );
  },
  methods: {
    updateCompilation(data) {
      this.compilation.push(data);
    },
    getDate(date) {
      const data = new Date(date);

      const month = data.getMonth() + 1;

      return (
        (data.getDate() < 10 ? "0" + data.getDate() : data.getDate()) +
        "-" +
        (month < 10 ? "0" + month : month) +
        "-" +
        data.getFullYear()
      );
    },
    choseLanguage(language) {
      this.selectLanguage = language;

      if (this.selectLanguage === 0) {
        this.language = this.$ru;
      } else if (this.selectLanguage === 1) {
        this.language = this.$en;
      } else if (this.selectLanguage === 2) {
        this.language = this.$tur;
      }
    },
    updateBlockClient(data) {
      this.isWithClient = data;
    },
    openScheme(data, id) {
      this.openCheme = true;
      this.selectFlat = data;
      this.selectFlat.isOpen = id;
    },
    openCreateSel() {
      this.openCreateSelection = true;
      this.openAddSelection = false;
    },
    closeChess() {
      this.chess = false;
    },
    closeAddClient() {
      this.addClient = false;
    },
    closeCreateSel() {
      this.openCreateSelection = false;
      this.openAddSelection = true;
    },
    addToFavorite() {
      this.flagFavorite = true;
      axios.post("/api/favorite/add", {
        user_id: this.user.id,
        house_id: this.house.id,
        token: this.user.token,
      });
    },
    removeToFavorite() {
      this.flagFavorite = false;
      axios.post("/api/favorite/deleted", {
        user_id: this.user.id,
        house_id: this.house.id,
        token: this.user.token,
      });
    },
    updatedMap() {
      let id = 0;

      this.markers = [];

      this.markers.push({
        position: {
          lat: +this.house.latitude,
          lng: +this.house.longitude,
        },
      });
    },
  },
  mounted() {
    this.updatedMap();

    if (this.house.frames.length > 0) {
      this.house.frames.forEach((item, idx) => {
        if (idx === this.frameId) {
          item.flats.forEach((item, idx) => {
            if (idx === 0) this.selectFlat = item;
          });
        }
      });
    }

    this.isWithClient =
      localStorage.getItem("withClient") === "true" ? true : false;
    this.flagFavorite = this.house.favorite;
    this.arrayInfos = [];

    if (this.house.info.info !== null) {
      let info = this.house.info.info.replace(/[^\d]/g, " "),
        arrayInfo = info.split(" ");
      for (let key of arrayInfo) {
        if (key !== "") {
          this.arrayInfos.push(this.infos.find((item) => item.id === +key));
        }
      }
    }

    if (this.house.info.dop !== null) {
      let dop = this.house.info.dop.replace(/[^\d]/g, " "),
        arrayDop = dop.split(" ");
      for (let key of arrayDop) {
        if (key !== "") {
          this.dops.forEach((item) => {
            if (+key === item.id) {
              item.active = 1;
            }
          });
        }
      }
    }

    this.house.flats.forEach((item) => {
      if (item.status == 0) {
        this.house.promotion = true;
        return;
      }

      this.house.promotion = false;
    });

    if (this.house.city_object.latitude !== null) {
      this.city = {
        lat: parseFloat(this.house.city_object.latitude),
        lng: parseFloat(this.house.city_object.longitude),
      };
    } else {
      this.city = null;
    }

    this.mainPhotos = this.house.images;
  },
  computed: {
    countFlats() {
      let count = 0;
      this.house.frames.forEach((item) => {
        item.flats.forEach((flat) => {
          count += 1;
        });
      });

      return count;
    },
    minPriceFlat() {
      let prices = [];
      this.house.frames.forEach((item) => {
        item.flats.forEach((flat) => {
          prices.push(flat.price);
        });
      });

      return Math.min(...prices);
    },
    minSquareFlat() {
      let minSquare = [];
      for (let key of this.house.frames) {
        for (let flat of key.flats) {
          minSquare.push(flat.square);
        }
      }

      return Math.min(...minSquare);
    },
    maxSquareFlat() {
      let maxSquare = [];
      for (let key of this.house.frames) {
        for (let flat of key.flats) {
          maxSquare.push(flat.square);
        }
      }

      return Math.max(...maxSquare);
    },
    minPriceForM() {
      return Math.round(this.minPriceFlat / this.minSquareFlat);
    },
  },
  components: {
    AppMap,
    AppHeader,
    AppFooter,
    AppDecritionObjectSidebar,
    AppDescriptionObjectOtherJK,
    AppModalAlbum,
    Swiper,
    SwiperSlide,
    AppAllNews,
    AppAddSelections,
    AppImmovablesCreateSelection,
    AppChess,
    AppChessScheme,
    AppMoadalAddClient,
  },
  setup() {
    return {
      modules: [Navigation, Pagination],
    };
  },
};
</script>

<style scoped>
.disableColor {
  color: #8a8996;
}

.send_client button {
  cursor: pointer;
  transition: 0.3s;
  background-color: white;
  color: #e84680;
  border: 1px solid #e84680;
  line-height: 1.1;
}


.hitn-icon{
  position: absolute;
    right: -25px;
}

.hitn-icon img {
  width: 15px;
  height: 15px;
  cursor: pointer;
}

.hitn-icon:hover + .hitn-text {
  opacity: 1;
  visibility: visible;
  transition: opacity 0.2s, visibility 0.2s;
}

.hitn-text {
  position: absolute;
  word-break: unset;
  width: 220px;
  right: -260px;
  padding: 5px;
  background: rgb(246 243 250);
  color: rgb(100 53 165);
  border-radius: 5px;
  left: auto;
  font-size: 10px;
  line-height: 12px;
  text-align: center;
  opacity: 0;
  visibility: hidden;
}

.send_client button:hover {
  color: white;
  background-color: #e84680;
}


@media (max-width: 992px) {
  .send_client button {
    height: 32px;
  }

  .hitn-text {
    position: absolute;
    word-break: unset;
    width: 181px;
    top: 24px;
    right: -42px;
    padding: 8px;
    background: rgb(246 243 250);
    color: rgb(100 53 165);
    border-radius: 5px;
    left: auto;
    font-size: 12px;
    line-height: 14px;
    text-align: center;
    opacity: 0;
    visibility: hidden;
}
}
</style>
