/*
 * File: c:\Users\grosales\Documents\project-falcon\Project-Falcon\resources\js\components\calendarComponent.vue
 * Project: c:\Users\grosales\Documents\project-falcon\Project-Falcon
 * Created Date: Monday, April 1st 2019, 10:30:11 am
 * Author: Gabriel Rosales
 * -----
 * Date Modified: 04/04/2019, 2:29:52
 * Modified By: Gabriel Rosales
 * -----
 * Copyright (c) 2019 Avuncular Digital
 * MIT License
 *
 * Copyright (c) 2019 Avuncular Digital
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy of
 * this software and associated documentation files (the "Software"), to deal in
 * the Software without restriction, including without limitation the rights to
 * use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies
 * of the Software, and to permit persons to whom the Software is furnished to do
 * so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 * -----
 * HISTORY:
 * Date      	By	Comments
 * ----------	---	----------------------------------------------------------
 */


<template>
  <full-calendar :events="events" :config="config"></full-calendar>
</template>

<script>
import { calendarAPI } from "../../views/auth/keys/googleCalendar.js";
import axios from "axios";
import { FullCalendar } from "vue-full-calendar";
import "fullcalendar/dist/fullcalendar.min.css";

export default {
  components: {
    FullCalendar
  },
  data() {
    return {
      events: [],
      config: {
        weekends: false
      }
    };
  },
  mounted() {
    // grabbing data from the api
    const getHolidays = () =>
      axios
        .get(
          "https://www.googleapis.com/calendar/v3/calendars/" +
            calendarAPI.CALENDAR_ID +
            "/events?key=" +
            calendarAPI.API_KEY
        )
        // getting the response from the api
        .then(res => {
          // filtering the inital object the api returns
          const data = res.data.items;

          //conditional filtering to only grab holidays that aren't student
          const filteredResult = data.filter((item, i) => {
            if (
              item.summary.includes("Holiday") &&
              !item.summary.includes("Student")
            ) {
              return item;
            }
          });

          // getting the values from the api object and mapping through them to get only the values that are needed
          const dates = filteredResult.map((item, i) => {
            console.log(item);
            const timespan = {
              id: i,
              title: item.summary,
              description: item.summary,
              start: item.start.date,
              end: item.end.date
            };
            return timespan;
          });
          // should return only the new object
          return dates;
        });

    // grabbing promise from getHolidays function and mutating the events prop directly. Not ideal, but this works for now.
    getHolidays().then(data => {
      let events = data;
      this.events = events;
    });

    const holidays = this.events;
  }
};
</script>
