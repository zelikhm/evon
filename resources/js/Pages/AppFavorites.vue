<script setup>
import { Link } from '@inertiajs/inertia-vue3'
</script>

<template>
  <app-add-selections v-if="openAddSelection" @close-add-selection="openAddSelection = false"/>
  <app-create-selection v-if="openCreateSelection" @close-create-selection="openCreateSelection = false" />
  <app-header :user="user" @selectLanguage="choseLanguage" :language="language" />
  <main class="relative">

    <div v-if="state === 0" class="absolute w-full text-center favorites__banner py-3 xxl:py-2.5 xl:py-2 text-[#30CB6E] text-[18px] xxl:text-[15px] xl:text-[13px] lg:text-[16px] leading-none">
      {{ notificationTitle + ' ' + language.izbr_1[6] }}
    </div>
    <div v-if="state === 1" class="absolute w-full text-center bg-[#E84780] py-3 xxl:py-2.5 xl:py-2 text-white text-[18px] xxl:text-[15px] xl:text-[13px] lg:text-[16px] leading-none">
      {{ notificationTitle + ' ' + language.izbr_1[0] }}
      <button @click="cancelDeleted" class="bg-white text-[#E84780] text-[14px] xxl:text-[12px] xl:text-[10px] lg:text-[13px] leading-none px-2 xxl:py-1.5 xl:p-1 py-1.5 rounded-[3px]">{{ language.izbr_1[4] }}</button>
    </div>

    <div class="_container">
      <div class="flex flex-col gap-2.5 xxl:gap-2 xl:gap-1.5 mt-16 xxl:mt-12 xl:mt-10">
        <h2 class="font-semibold text-[22px] xxl:text-[18px] xl:text-[15px] lg:text-[20px] leading-none">{{ language.izbr_1[1] }}</h2>
        <span class="text-[#8A8996] text-[14px] xxl:text-[12px] xl:text-[10px] lg:text-[14px] leading-none">{{ language.izbr_1[2] }} {{ favorites.length }} {{ language.izbr_1[3] }}</span>
      </div>

      <div v-if="favorites.length === 0" class="grid grid-cols-2 lg:grid-cols-1 mt-10 xxl:mt-8 xl:mt-6">
        <div class="flex justify-between sm:flex-col sm:items-center p-7 xxl:p-5 xl:p-4 bg-[#F6F3FA] rounded-[10px]">
          <div class="flex flex-col gap-4 xxl:gap-3 xl:gap-2.5">
            <span class="text-[18px] xxl:text-[15px] xl:text-[13px] lg:text-[16px] leading-none font-medium">{{ language.izbr_1[5] }}</span>
            <p class="text-[#8A8996] text-base xxl:text-sm xl:text-xs lg:text-[15px] leading-none"></p>
          </div>
          <svg class="h-full" width="162" height="113" viewBox="0 0 162 113" fill="#6435A5" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
            <rect width="162" height="113" fill="url(#pattern0)"/>
            <defs>
              <pattern fill="#6435A5" id="pattern0" patternContentUnits="objectBoundingBox" width="1" height="1">
                <use xlink:href="#image0_134_1230" transform="translate(0 -0.0526316) scale(0.00306748 0.00438596)"/>
              </pattern>
              <image id="image0_134_1230" width="326" height="240" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAUYAAADwCAYAAAB8M80sAAAZ6ElEQVR4nO3dbWxc13kn8P9zOOaMFAFmYM/ltPVCbOA6dddbqWnWCl8WMddFkzgprKSO34FoESOx07RW4MSxU5E8HAoL2XFgGbtJ5NSFJcCx0sZNZDSregOno2zJoeQWXbnrjRLvS+WFnJAzNkADqaShOefZDxzKM3fuvL8P/79P5J1z731EXT6899xzngMQEREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREdEmJZ0OgHpbbHZ+0ol5GoCnim+lZ8b2djomokaZTgdAvS0r5usAtgPYIoL7o/tPTnQ6JqJGMTFSQwS4tmCD06s7FApR0zAxEhH5MDESEfkwMRIR+TAxEhH5MDESEfkwMRIR+TAxEhH5MDESEfkwMRIR+TAxEhH5MDESEfkwMRIR+TAxUl1GbCIybBeu828XdSPDdsHrRExEzcJ6jFS1qE1sMyZ8jwK3A/hdAKEyzc8B+IE4/fqyHX+lPRESNQcTI1VleHbxNhU9CCBWx+6H1GW+lLaTv2x2XEStwMRIFUVnkwdFcH8jx1DgzICTm5bs6NlmxUXUKkyMVJY3u/gYRB9o0uFeE6fXL9vxVJOOR9QS5fqIaJPz5pK7oYFJ8U0B/kzU/XBNL3s9BLd66ZOQes7J+wDdA2CXb7/tauQIgI+0MGyihvGOkQKN2ETkvAn/LwBX+T763qrLfHrFTq5UOkY0vrhHoN8AsKXgA8HHU1Njx5oXLVFzcbgOBfoXE7kdAUkxNT32h9UkRQBIT48eVnG3AFgr+EDxUHOiJGoNJkYKJNC7fZtWVl3m07UeJz01cRzAU77Nu2J2caTu4IhajImRitlECMBYwTaVP6/2TtHPuYHH/duyBjfUFxxR6/HlCxWJIXKVg/r6BXXCiyfr7BfMAsAF5PU1Guh764+QqLWYGKlI1uCGgLdy/jfMjRodsYnIWTt5scnHJWoY30rTO2wi5JnwfwJwbztOp8AZ4/RWThmkbsPESOvWk+JfA/hwm8/8ljH4/aV9Yy+1+bxEJTExEgDAiye/iRJ3igqcEeBVCOp6+QJgEIr3oHThiSVxuoMzYqhbsI+REJ2bvwkamBSfF6f7Uk161I3axDYMDP6RqMygcNB3TI18C8DuZpyHqFG8YyR48cXTgO4o2Kg6m5oZt604X9Qu7BQjLwK4In+7MdjFR2rqBhzHuMlF95+cKEqKgqOtSooAkLbjp426T/q3O8XnWnVOolowMW5yxrmP+jatmax8pdXnXZqZSAB4vmCj4mOtPi9RNZgYNzkFduZ/L8BCu2omispR36YrOFWQugH7GPvcsF24To18FZBfCW6h16DwRcibgJxrR2wKHRTg2sJtOCOQ1YDWFwX4zvL02MF2xEabGxNjn4vGkz/xJ59epsb8u/S+D8x3Og7qb3yU7mNRm9jWT0kRAIxz7+90DNT/mBj72Nscp0pUF/7ibDaCo3D6aqfDqJrIXgCXdzoM2lyYGDefv0zNjPfMsgJePLkHTIzUZnyUJiLyYWIkIvJhYiQi8mFiJCLyYWIkIvLhW2nqG1G7sBMD+JA4bKncuksY+ReXHXj+Dburd4ZQbQJMjNQXYvuT1zuHBShCPTXRVQFjsn8as4s721W8gyrjozT1BXX4OHr3D/3lXGe7uzAxUl9w2kOPzwEMdKjTMdA7evUvLFElFwB08+Ja2zsdAJXGxEh9SYCXlqfHuvbx1IsnV8Cpjl2Lj9JERD5MjEREPkyMREQ+TIxERD5MjEREPkyMREQ+TIxERD4cx1iKTYRiofD7dE3PLtvxbh4oTERNxjvGAFGb2OaZyD84h1Nq5HVvdvGxEZuIdDouImoPJsYgJnILoDty34Ug+sB5E/5pdG7+po7GRURtwcQYoMSE/u2i5r94c8lnh+2C1/agiKhtmBhrpbhDjfwkGl/c0+lQiKg1mBjrc4VAn/biyRdjdnGk08EQUXMxMTbmRmf0J95c8kuwCb7hJ+oT/GWuzlsq7k5R8ySAq3yfbYHiUc9E7lK7sCdtx093IkCqXcwujmThAgvEGuDn5YZpldu3SoMN7EstxsRYpfTUxPGoTVwLCe8XwR+h6GenO8TI33uzi09s1Yv7ztrJix0JlCqK2sQ2MeEXHXSXlFggRgF48eSh1PTYffnbh2xiaNBETjjojlL71kMFlzXtYNQwJsYapO3kLwHsje1PPuucfCtvSM+G9aE9Er4lOjf/ufTUxPFOxNlSNhEaNuHPq2BnW86n8Aq/xe3eXLLo3Kq4vtpDioncDeiuKpree6U99Xj+Cn5hE96jxf/vzfCvW3BMqhMTYx2W9o29BJt4f3Rg8AFRmQGK1hvZGNpzVLK6t59mzgyb8JwCD0E7FsIuKIqSmv/eTYGSL8UEGqk2/AGs8ZF3E+LLl3rZybX01Pgjzg3sFODHgW36cGiPApOdjqFKJZcNyLjMYQXOVDyC4OiyHX+lYJvTZ6vat3b/swXHpDrxjrFBucesG6LxxT0CfRyAv0N+Y2jP3cbJPb2/drBE0MHbxWZYsZMrsInfHsbgb7oSvwMDMCtB/1fLdjxVad9qiJEk8p40RPF2vcei5mNibJL09OjhYbtwXAfkIBR3BDTZGNozk8pmHoedXGt7kK3xmgAtS/YKRAD8GoAtCqRMiZX/FLgexV0apdnJtWXglcoNm7xvjhdPrqKWeKmtmBibKNeXeGd0bv6ZTTO0R/Xw8sy47XQYXnzxdMDLMKK6sI+xBdJTE8fVZa5VxRMAAu4MLw3tYdUeoi7ExNgiaTv5y/TM2F5jMA7IywFNWLWHqEsxMbbY0r6xl1Lu4vtV9CEAFwKasGoPUZdhYmyHvKE9AH4U2KYPh/YQ9SomxjZ6w+56NTU99nsK+Q8A3gxowqo9RF2AibED0tOjh8Xpb0FwtEQTVu0h6iAmxg5ZtuOp1NTYnSruowBeC2iyMbTnH6J2oT3zkokIAMcxdlyuas91rNrTXl588V6B3q6QEqXD9BdG3aNLMxMJ/yfD8eReALtL71sNfVf9+9Zm2C5cp8ZMqHMn+2LsbBswMXYBVu1pr+jc/E1Q/eb6xMaS0xt3ODEfHLKJX12xkysbG7255G5VPI7y+9ZMVfyTARoWm52fdGL+VIEbAYUYWYvOzd/M66cyPkp3EQ7taRf5N1U23BIJha/J36DQ97YgIMDorzblODYRGp5dvM2LJ086MX8L4Ma8T0Oi5tNNOU+fY2LsNrUM7eHA8Ppk8V8ROCOpyLnIWuaf8jcMiCSq3LcmooH9zFUbsYmIF1+81zPh/62i3wGKS7PlDDRyns2Cj9JdKle15/dyVXseA3CFr8kVoua5qE14uUdxqlLajp+O7j85aZz7qNPgQg4CXTFqDvv7dJf2jb1Uad9qiOAzKCwisVzPcYZsYuiygcHPnlfZC2is3nioEBNjl6tQtWcLMHg1AHao1yi97wPzAObbve8GL57cgwaq6wzbBU/FPAjRz6GBBE3BmBh7wKWqPfHFHwr06U7HQ51zpT11jRnIfkUVdwFa7vf3AoAjWK9k/uH2RNc/2MfYS5zjneEmFdufvN6LJ48Zk/0ZFJ9C6ZuaN6E6K05HUtNj90Hqe0Tf7HjHSNTFonPzNxk1DzqHD1Zoek6ArzmXeYp9zo1jYiTqNjYRiprI3QLsheqOcqMl19efkUfT7uIzfVQVvuOYGIm6RNQmthkTvkeBBwAtO+BbgB87cY9ysHZrMDESdQEFPiQmvE+Lh2X5PW8M/uPSvrGX2hLYJsXESNQdyr05XoPg25LVx4qWc6WWYGIkarNctaRqikhcgMo3RN2juSFb1CZMjERtkivq8CAqjytcUtGDb2dXn8wvYEHtw8RI1Eo2EfIGwh+D4iFXev7yhtcAObDVXSyaikjtxcRI1Ao2EfJM5B6F/gkU11ZsLziSymbu4ZCb7sDESNREG0UdJFfUQarcTxSnmRS7BxNjjxMj/92LJ6vfQfH9mtoHHKCSIZsYGjThowBGAZxYdZk9QX1lw3bBUyNHNtqpy9wdNGuj2nadNGwXPBj5ggL3QXF5maZrEHwXit1ooIgEtRbnSveQAdF3dzqGIiJFLxLCJvxlrL9guBzAzYMyuDdoV33nRcTlAG4WGfxiI+064Up76hovnvymGnldgYeAkknxAoBDxslvpKbG7gSw2r4oqVa8Y+whzpj3N7GafrMU1QBU+PrUjAQvBSt6dVPbtVFsf/J65/BlIPuJCk1XBDgEp49zyE3vYGLsIQo1gmp7ragV6inqkOqyx36qjImxxylwRoBXKzSLARIB9BcAMg2e8uYG9+89NhEalsgfquBhFnXYHJgYe53okdTU+CPtOp0XT76NTXLdjNhE5LyJ7AH0IYVur9D8FAQH0lNjx9oSHLXUprjAWyVqF3aKEQvBimT1wVJ9SLn+qK80qx21Xmx2fvK8mO8CWrGogxrzWG65A+oTTIwNECPHAGyHAjogALAnqJ1z+Mua2xm5AOC+1kROlWTFfF1KV7phUYc+x8TYmEuPV6Io96a09nb+N7vUVgIErfN8ASrfMIr/vGRHz7Y9KGobJkaiagiOrGYze1nUYXPgAG+iKqjKCSbFzaMr7xhjdnEkCzfUqfOrylWQ7htJHURUDnjx5IFOx0HUT7oqMebm2L7goLs6O5C5KCkOlmj4GnL9gir4eZkDngNwVa5dub6psu3EYUsXju/e1ukAiJqtqx6lB03kdlSuWdcJlwVtNAa3CvBjAN+TrAbOBwYANeaOvHYP1ttORMJ1xN5qA50OgKjZuuqOEepikO67JUKJn1NuQaIbKu2cG+PWcDsnuiLadT8fTnejvtNdiZHqcQqCn7btbIpP+bZk23Zuojbp6sSowBk4vbPd5zVGDioqFgnoCir6/XR7pwTehS6/boga1dUXuEBWU3bsdLvP68WTHJZBtIl11cuXXhTdf3Ji2C5c18x2V9pT1zQnOiKqBxNjA7y55GFx7u/UyP+IxhcD5z/X086Y7M+GZxdva03URFRJVz9Kdz3FXRtfCvRuAIeraHdbNe1UdA+Av2hSpNQnrrSnrjED2d9SlSGjuCAD+s+Rtcw/cbnV5mJibMyln5+U/1nmtyu3AFK17d7h5FeidmFnVW2bg9dMmw3ZxNCgDO6FyB4gux0KCBQqgDrgvAlf8OaSxzSrj6bteNv75PsRL/IeJ4L7IXJ/p+Og1vDmkruheAqlS6ABwBYo7hAjd3jx5KGtLvMF3kE2hn2MPURcVy63ySmBLeLNJb8ExfdRPin63XvehE8M2UTHag30AybGxlxa00Pzvq7Q7kK97TglcPMYnl28DYpH69x916AJPweb4BNhnZgYG/PUxhcKeaZkK8G3L32pEvzipYp2TrQbx1dySmCTxeziiIo+HfDRkgBfME5+PeUyl626zLsh+DiAHwW0vXHYhD/f4lD7Fv+iNCA1PXZfbH/y6bW1gZU37K6SK/Wlpsb2xPYnv9Gsdj7PC3Ci5uDrpMDjvk2cEthkzuiXUfzy7UerLnNLfk3IFWAFwDEAx7z44r2AfjN/BwUsgOMtD7gPMTE2KFdIou3tNqjoYmpq/GAt+zTCiye/Cl43LZPrGyyYj74+NTaze6XM+tSp6dFD3uxCDCIzeZsvh+I9rYq1n/XfBW4ToRgiV2XhhgywlsHqOVZepl4xOBC+AVp4tyiCr6Tyk6JNhK7E1vcIzv88nbd9q64eOC/hTyNX0zPn11oedB/qi8Q4ZBNDYRPeA2C3AuMOGhIIFMAgwvDiyddUcQyqhznOi7qa052+0nsrqWzmBxvfRG1im5jIPJDdAYQvROfmb0lPTRwHgLN28mJ0NvlXIsgfvlXLG23K6e3EaBOhYRP+vAJWgcvLtNy+Md7Piye/Z5w8wFXeqCuJDPu2/Ax28tJoBTGRuwHdkft2i6iZRl4/ooj81FeBvqYhXrHZ+Ukn5lYAv4P1u80QIMsQPS1O/maLXnx+M4yR7NnEmFsG4TkFbqxx1084o/8+Ojd/18Zf2npF95+cMM7tV2DFONlbKtlW2y42Oz+pYmYUWBGnn1m246lG4qM+VFzMOdaMw8Zm5yezYr7uApft1RgUO1T0U+clvBSNLz6cnh4tPbqiD/RkYlxPipETeX85az6EqHnem0t+MjU1dqzeOMS5o5rrz3EDeh5AYO3Iats5Mc8id6HrgKwAKFlw4tKxITvaWXBCoT15zfQM1WVf4nsvbCKUf9dYfnf9TV8R/AuocNfozS5YJzJTZW34mECf9uLJP9jqMnf1691j713kNhEaNOHnSiTFJah8W032bwfEvIGse5eK2YH1vkd/4dkQFN+N2oV/20C/46VObtHABdprbRfLazdSVQSKO1T0jqratgYHeDeTkdO+tdiGvIHwx1Lrw3LKGrGJyHmB/4/kmyh8GVPAm118DKIP1BHpJ86b8A9gEx+uNmn3kp5LjLk+xaLHZwEObHGZ2YC/YAkAB3N9J08jt6pfTghGnoVN/HYv/Od26SqB3ThNsWdpNvOimHDhXZ7i4JBNVFzX+oIJz6D40fp1lEiMw7OLt2lwUlwD8KIAp1U1AyPXQHETivvxb/QkciAFfLHCP6vn9NTMl6hNbMsNWi0gKrcvT489XO62fmlmIiFOr1fgTMG+wLWeidzTiniJapUbfnPEt3l72ISPDdsFr9R+0bmFLyvwkG/zmxD838D2NrFNRYPGv75gnPxGanrsI8vTYw+nZsZtamrszlWXGVHFE0WtRe+vpgBzr+mpxGhM+B74/2qpzi7PjFZVt3DZjqfUDeyGbx6yQv+kaUG2kJqy86w7pRtj6mnidAbAW/nbFPigGvkJRCZ8zbd58eRJUTlQdBxgP4DVoHPkfpf8d5ffS7nMHwS9HFyxkyvpmbG9KupPviEdkL67Y+y1R+ndvu/PbdXVoguinDfsrleH48kn8v+6CnDtsF24btmOv1JjPK8h92iugnLDf95p57tjrbPdOwRHxcnzVbVtAhX9jm8TpwQ22bIdTw3PLn424Gd9BYq7ka5A8FjFF5anxw56c8nAt8cK3O7btKQu86lKXUrpqfFHhuPJjxT02StuhU3c0wvdUdXqncRoEyEFxvM3CfBMPW/FxMmTagr/8qkxEwBqSozqdLcYsRCsSFYfrKbdajbzcMV2wC9WXel2BftAX07NjLWt0rcXTz6DXrpuetTyzOhfePHFd/vnP1dDgB87l/lkqc9HbCJyHvjdgo2qT6bLTDnM58Q9KmryX2ZuiYXC71sCaprO2s165gK/ElvfA2QL4hV1P6znWEt29KwXT166OwMAKK6u9Ti5t9n+u9iWt6PNITU9eig6N///RM2TKPNmOc8aVJ5Y1osPlbt7u4DBq+H73deBgRfzv79UNRxmm1PzrYKiJtm3/xtMYQU8zcqvo48SY8/0MYZC2aLCm2t62ev1Hk/ge/Q1emW9xyJqlfTUxHF1mWsheLBM98pbEBwRp7+Tmhn9YqVHWhdwQ2TWsgVvvAdN+AWIzED0AWOyyahNXCpInLuzLOhbdtJfoxN65o4RWfcuSGEeD8EFdixXQ9dLNhF1vVwi+iqArwaMO1xKucy/qqV/zwBr6tsmotGNr3NJcFfex1cgtGUngHngUgWggkRotL9ewvXMHSMRAYDz9wNman3psYzVn8JXcV7F/P7G128H3DANZNcu2/g6LJEP+T+XAf3nWmLodr1zx0iBRGV0OJ7c267zKa+Z3mcn1ySeXMh/s6zAvUM28UjFEn02EVLRL/i2vrW0lvnHVoTaKbzIe9/NCtzcwfNzSmAPUsh3AM1/szw0aMLPjdjEx8plRk8iBwDd5dt8tJ+G6gB8lO4pRqUbV37jKoE9aKu7eBjr42bz3XjehE9cFtpSNJNFMeB58eRfBcyrXjNOHmlZoB3CxNhDVDXT6RgCBA3wrnbQd7PbUZXO2smLKu5zAR/tEuf+zr9RRZ8B8ImA7fv6sbYpE2MP6dIpgUWDglX0Jd+Gk0E7Nrsd1SY9NXE8YIpfKcXdboKj6ezq15obVXdgH2PvO6TGfLtys+YIupvwS2dXv+bJ4BaI7FLRE+ls5ql2tKPa5ab4ZXR9OFAt+eBQKpv5437rW9zAxNjjVPRset8H5tt1Pi+eXEOl68ZOrqUCqiC1vB3VZXl67GDULpwwRg4G1C0toMAZiPtio9Xvux0TIxFtTEe9YdguXAcjdxWVMBMcNc792dLMRKIzEbYX+xiJ6JJlO/5KxmWK3jJvpqQIMDESERVhYiQi8rm0gkhsf/J6F7BQk8nK6ZLjlGwiFA1t+YCoa1ZlmluhyF/YaUmAwwCggu2+zwDgBQDn6zzXGAoqGMvLAv0bAHDAzeJbRlKAmgritshocee4vAzo/2ljDP6xbG8JUHPNwGbT9RUV8ytSXxAElOKv/nj3o7BQwgsC1LtoWuXjC46gigWvUPw78iYEJZfmEMVe3zVzClL+WhYn4aIiuaqzMNK0f385RvDzpX1jHS1hJkDFlcLWVNzNQW+hvHjyGDo7HY2I+pHK11Izox1bMmH9UVo0aAT8hpCo+Yx/Y8wujoBJkYhaoXxOarmNPsY3y7aS4tqFF3FxBb7SRURETVI+J7WYAQAV91kA54KbyMsmK0WDa9fLE8kfw7eaGRFRg87lchIRERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERE1x/8HXVOAhNoGdFwAAAAASUVORK5CYII="/>
            </defs>
          </svg>
        </div>
      </div>

      <div class="grid grid-cols-5 x:grid-cols-4 lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-1 my-8 xxl:my-6 xl:my-5 gap-5 xxl:gap-4 xl:gap-3">

        <div class="relative block__favorites rounded-[5px] transition-all" v-for="item in favorites">
          <div class="relative">
            <img v-if="item.house.images.length === 0" src="../../assets/no-img-houses-zastroy.jpg" class="object-cover relative z-0 h-[240px] exl:h-[12.5vw] x:h-[16vw] lg:h-[23vw] md:h-[30vw] sm:h-[52vw] w-full rounded-[5px]" alt="">
            <img v-else :src="item.house.images[0].isResize === 1 ? imageServiceUrl + item.house.images[0].name : item.house.images[0].name" class="object-cover relative z-0 h-[240px] exl:h-[12.5vw] x:h-[16vw] lg:h-[23vw] md:h-[30vw] sm:h-[52vw] w-full rounded-[5px]" alt="">
            <div class="seek opacity-0 transition-all immovables__overlay top-0 h-full w-full absolute z-10 rounded-[5px]"></div>
            <div class="seek opacity-0 transition-all absolute top-1/2 -translate-y-1/2 left-0 z-10 flex flex-col items-center gap-3 xxl:gap-2 xl:gap-1.5 w-full">
              <button @click="openAddSelection = true" class="immovables__button--card flex items-center justify-between p-3 xxl:p-2 xl:p-1.5 rounded-[4px] w-[60%]">
                <span class="text-white text-sm xxl:text-xs xl:text-[10px] lg:text-[14px] leading-none whitespace-nowrap">{{ language.rielt_1[14] }}</span>
                <img src="../../assets/svg/plus_icon.svg" class="w-5 xxl:w-4 xl:w-3 lg:w-5" alt="Плюс">
              </button>
              <button v-if="item.house.favorite" @click="removeFavorite(item)" class="immovables__button--card flex items-center justify-between p-3 xxl:p-2 xl:p-1.5 rounded-[4px] w-[60%]">
                <span class="text-white text-sm xxl:text-xs xl:text-[10px] lg:text-[14px] leading-none whitespace-nowrap">{{ language.izbr_1[4] }}</span>
                <img src="../../assets/svg/heart_icon_fill.svg" class="w-5 xxl:w-4 xl:w-3 lg:w-4" alt="">
              </button>
              <button v-else @click="addFavorite(item)" class="immovables__button--card flex items-center justify-between p-3 xxl:p-2 xl:p-1.5 rounded-[4px] w-[60%]">
                <span class="text-white text-sm xxl:text-xs xl:text-[10px] lg:text-[14px] leading-none">{{ language.rielt_1[16] }}</span>
                <img src="../../assets/svg/heart_icon.svg" class="cursor-pointer w-5 xxl:w-4 xl:w-3 lg:w-4" alt="">
              </button>
            </div>
            <div class="absolute left-0 bottom-0 flex items-center gap-2 xl:gap-1.5 z-20 p-5 xxl:p-4 xl:p-3">
              <span class="text-white text-sm xxl:text-xs xl:text-[10px] lg:text-[14px] leading-none">{{ item.house.area }}</span>
              <div class="bg-white w-1 h-1 rounded-full"></div>
              <span class="text-white text-sm xxl:text-xs xl:text-[10px] lg:text-[14px] leading-none whitespace-nowrap">{{ item.house.flats.length }} Квартир</span>
            </div>
          </div>
          <div class="p-5 xxl:p-4 xl:p-3 flex flex-col gap-3.5 xxl:gap-3 xl:gap-2.5">
            <div class="flex justify-between items-center">
              <Link :href="'/house/' + item.house.slug" class="text-[#1E1D2D] text-[20px] xxl:text-[16px] xl:text-[14px] lg:text-[20px] font-semibold leading-none">{{ item.house.title }}</Link>
              <img @click="addFavorite(item)" v-if="!item.house.favorite" src="../../assets/svg/heart_icon_grey.svg" class="cursor-pointer w-6 xxl:w-5 xl:w-4 lg:w-6" alt="Сердце" >
              <img @click="removeFavorite(item)" v-else src="../../assets/svg/heart_icon_pink.svg" class="cursor-pointer w-6 xxl:w-5 xl:w-4 lg:w-6" alt="">
            </div>
            <span class="text-[17px] xxl:text-[14px] xl:tex-[12px] lg:text-[16px]  text-[#1E1D2D] leading-none whitespace-nowrap">от {{ item.house.minPrice !== null ? item.house.minPrice.toLocaleString('ru') : 0 }} €</span>
            <div class="flex items-center gap-2 xl:gap-1.5 text-[14px] xxl:text-[12px] xl:text-[10px] lg:text-[14px]">
              <div class="w-1 h-1 bg-[#8A8996] rounded-full"></div>
              <span class="leading-none whitespace-nowrap">{{ item.house.minSquare !== null ? item.house.minSquare.toLocaleString('ru') : 0 }} м² - {{ item.house.maxSquare !== null ? item.house.maxSquare.toLocaleString('ru') : 0 }} м²</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <app-footer :language="language"/>
</template>

<script>
import AppHeader from "@/Layouts/AppHeader.vue"
import AppFooter from "@/Layouts/AppFooter.vue"
import AppAddSelections from "@/Layouts/modal/AppAddSelections.vue"
import AppCreateSelections from "@/Layouts/modal/AppAddSelections.vue"

import { computed } from 'vue'
import { usePage } from '@inertiajs/inertia-vue3'

export default {
  props: ['favorites', 'user'],
  components: {
    AppHeader,
    AppFooter,
    AppAddSelections,
    AppCreateSelections,
  },
  data() {
    return {
      openAddSelection: false,
      openCreateSelection: false,
      state: null,
      notificationTitle: null,
      deleteItemId: null,
      language: {},
      selectLanguage: 0,
      imageServiceUrl: ''
    }
  },
  created() {
    this.imageServiceUrl = this.$service
    if(this.user.lang === 0) {
      this.language = this.$ru;
    } else if (this.user.lang === 1) {
      this.language = this.$en;
    } else if (this.user.lang === 2) {
      this.language = this.$tur;
    }
  },
  methods: {
    getMinPrice(house) {
      let object = [];

      house.flats.forEach(item => {
        object.push(item.price);
      })

      object.sort((a, b) => a - b);

      return object.length > 0 ? object[0].toFixed(0) : 0;

    },
    choseLanguage(language) {
      this.selectLanguage = language;

      if(this.selectLanguage === 0) {
        this.language = this.$ru;
      } else if (this.selectLanguage === 1) {
        this.language = this.$en;
      } else if (this.selectLanguage === 2) {
        this.language = this.$tur;
      }

    },
    removeFavorite(item) {
      this.deleteItemId = item.house.id

      axios.post('/api/favorite/deleted', {
        user_id: this.user.id,
        house_id: this.deleteItemId,
        token: this.user.token
      })

      item.house.favorite = false
      this.state = 1
      this.notificationTitle = item.house.title
    },
    addFavorite(item) {

      axios.post('/api/favorite/add', {
        user_id: this.user.id,
        house_id: this.deleteItemId,
        token: this.user.token
      })

      item.house.favorite = true
      this.state = 0
      this.notificationTitle = item.house.title
    },
    cancelDeleted() {
      axios.post('/api/favorite/add', {
        user_id: this.user.id,
        house_id: this.deleteItemId,
        token: this.user.token
      })

      this.state = 0

      for (let key of this.favorites) {
        if (key.house.id === this.deleteItemId) {
          key.house.favorite = true
        }
      }
    },
  },
  mounted() {
    this.favorites.forEach(item => {
        item.house.favorite = true
    })
  }
}

</script>
