/*
 * File: /Users/gabrielrosales/Documents/GitHub/project-falcon/Project-Falcon/resources/js/components/ExampleComponent.vue
 * Project: /Users/gabrielrosales/Documents/GitHub/project-falcon/Project-Falcon
 * Created Date: Thursday, December 27th 2018, 1:24:22 pm
 * Author: Gabriel Rosales
 * -----
 * Date Modified: 02/20/2019, 11:48:23
 * Modified By: Gabriel Rosales
 * -----
 * Copyright (c) 2018 Avuncular Digital
 * MIT License
 *
 * Copyright (c) 2018 Avuncular Digital
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
 * Date 	By	Comments
 * ----------	---	----------------------------------------------------------
 */





<template>
  <div class="container mb-4">
    <div class="row justify-content-center">
      <div class="col-xs-10 col-xs-offset-1 visible-md visible-lg">
        <h5 id="quote"></h5>
        <h6 id="author"></h6>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  mounted() {
    const quote = document.getElementById("quote");
    const author = document.getElementById("author");

    let quoteArray = [
      "Success is most often achieved by those who don't know that failure is inevitable.",
      "Things work out best for those who make the best of how things work out.",
      "Courage is grace under pressure.",
      "If you are not willing to risk the usual, you will have to settle for the ordinary.",
      "Learn from yesterday, live for today, hope for tomorrow. The important thing is not to stop questioning.",
      "Take up one idea. Make that one idea your life -- think of it, dream of it, live on that idea. Let the brain, muscles, nerves, every part of your body be full of that idea, and just leave every other idea alone. This is the way to success.",
      "Sometimes you can't see yourself clearly until you see yourself through the eyes of others.",
      "All our dreams can come true if we have the courage to pursue them.",
      "It does not matter how slowly you go, so long as you do not stop.",
      "Success is walking from failure to failure with no loss of enthusiasm.",
      "Someone is sitting in the shade today because someone planted a tree a long time ago.",
      "Whenever you see a successful person, you only see the public glories, never the private sacrifices to reach them.",
      "Don't cry because it's over, smile because it happened.",
      "Success? I don't know what that word means. I'm happy. But success, that goes back to what in somebody's eyes success means. For me, success is inner peace. That's a good day for me.",
      "You only live once, but if you do it right, once is enough.",
      "Opportunities don't happen. You create them.",
      "Once you choose hope, anything's possible.",
      "Try not to become a person of success, but rather try to become a person of value.",
      "There is no easy walk to freedom anywhere, and many of us will have to pass through the valley of the shadow of death again and again before we reach the mountaintop of our desires.",
      "It is not the strongest of the species that survive, nor the most intelligent, but the one most responsive to change.",
      "The best and most beautiful things in the world cannot be seen or even touched -- they must be felt with the heart.",
      "Great minds discuss ideas; average minds discuss events; small minds discuss people.",
      "Live as if you were to die tomorrow. Learn as if you were to live forever.",
      "The best revenge is massive success.",
      "The difference between winning and losing is most often not quitting.",
      "I have not failed. I've just found 10,000 ways that won't work.",
      "When you cease to dream you cease to live.",
      "A successful man is one who can lay a firm foundation with the bricks others have thrown at him.",
      "May you live every day of your life.",
      "No one can make you feel inferior without your consent.",
      "Failure is another steppingstone to greatness.",
      "The whole secret of a successful life is to find out what is one's destiny to do, and then do it.",
      "If you're not stubborn, you'll give up on experiments too soon. And if you're not flexible, you'll pound your head against the wall and you won't see a different solution to a problem you're trying to solve.",
      "If you're going through hell, keep going.",
      "In order to be irreplaceable one must always be different.",
      "What seems to us as bitter trials are often blessings in disguise.",
      "You miss 100 percent of the shots you don't take.",
      "The distance between insanity and genius is measured only by success.",
      "The way I see it, if you want the rainbow, you gotta put up with the rain.",
      "To me, business isn't about wearing suits or pleasing stockholders. It's about being true to yourself, your ideas and focusing on the essentials.",
      "The longer I live, the more beautiful life becomes.",
      "Happiness is a butterfly, which when pursued, is always beyond your grasp, but which, if you will sit down quietly, may alight upon you.",
      "You must expect great things of yourself before you can do them.",
      "If you can't explain it simply, you don't understand it well enough.",
      "You can't please everyone, and you can't make everyone like you.",
      "There are two types of people who will tell you that you cannot make a difference in this world: those who are afraid to try and those who are afraid you will succeed.",
      "I believe every human has a finite number of heartbeats. I don't intend to waste any of mine.",
      "Start where you are. Use what you have. Do what you can.",
      "Don't limit yourself. Many people limit themselves to what they think they can do. You can go as far as your mind lets you. What you believe, remember, you can achieve.",
      "People ask, 'What's the best role you've ever played?' The next one.",
      "The two most important days in your life are the day you are born and the day you find out why.",
      "I find that the harder I work, the more luck I seem to have.",
      "It often requires more courage to dare to do right than to fear to do wrong.",
      "Success is the sum of small efforts, repeated day-in and day-out.",
      "As you grow older, you will discover that you have two hands, one for helping yourself, the other for helping others.",
      "If you want to achieve excellence, you can get there today. As of this second, quit doing less-than-excellent work.",
      "If your actions inspire others to dream more, learn more, do more, and become more, you are a leader.",
      "All progress takes place outside the comfort zone.",
      "The more you praise and celebrate your life, the more there is in life to celebrate.",
      "You may only succeed if you desire succeeding; you may only fail if you do not mind failing.",
      "A dream doesn't become reality through magic; it takes sweat, determination, and hard work.",
      "Only put off until tomorrow what you are willing to die having left undone.",
      "The biggest risk is not taking any risk... In a world that's changing really quickly, the only strategy that is guaranteed to fail is not taking risks.",
      "We become what we think about most of the time, and that's the strangest secret.",
      "Do one thing every day that scares you.",
      "The only place where success comes before work is in the dictionary.",
      "Don't be afraid to give up the good to go for the great.",
      "Your work is going to fill a large part of your life, and the only way to be truly satisfied is to do what you believe is great work. And the only way to do great work is to love what you do. If you haven't found it yet, keep looking. Don't settle. As with all matters of the heart, you'll know when you find it.",
      "Don't worry about failure; you only have to be right once.",
      "Though no one can go back and make a brand-new start, anyone can start from now and make a brand-new ending.",
      "Nothing great was ever achieved without enthusiasm.",
      "Twenty years from now you will be more disappointed by the things that you didn't do than by the ones you did do. So throw off the bowlines. Sail away from the safe harbor. Catch the trade winds in your sails. Explore. Dream. Discover.",
      "Keep your face to the sunshine and you can never see the shadow.",
      "The first step toward success is taken when you refuse to be a captive of the environment in which you first find yourself.",
      "One of the greatest diseases is to be nobody to anybody.",
      "Identity is a prison you can never escape, but the way to redeem your past is not to run from it, but to try to understand it, and use it as a foundation to grow.",
      "The successful warrior is the average man, with laser-like focus.",
      "Rarely have I seen a situation where doing less than the other guy is a good strategy.",
      "If you always do what interests you, at least one person is pleased.",
      "Keep on going, and the chances are that you will stumble on something, perhaps when you are least expecting it. I never heard of anyone ever stumbling on something sitting down.",
      "I avoid looking forward or backward, and try to keep looking upward.",
      "You can't connect the dots looking forward; you can only connect them looking backward. So you have to trust that the dots will somehow connect in your future. You have to trust in something -- your gut, destiny, life, karma, whatever. This approach has never let me down, and it has made all the difference in my life.",
      "Life is short, and it is here to be lived.",
      "Everything you can imagine is real.",
      "Change will not come if we wait for some other person or some other time. We are the ones we've been waiting for. We are the change that we seek.",
      "If you want to make a permanent change, stop focusing on the size of your problems and start focusing on the size of you!",
      "Successful people do what unsuccessful people are not willing to do. Don't wish it were easier; wish you were better.",
      "It is never too late to be what you might have been.",
      "If you love what you do and are willing to do what it takes, it's within your reach. And it'll be worth every minute you spend alone at night, thinking and thinking about what it is you want to design or build.",
      "In my experience, there is only one motivation, and that is desire. No reasons or principle contain it or stand against it.",
      "In the midst of movement and chaos, keep stillness inside of you.",
      "Success does not consist in never making mistakes but in never making the same one a second time.",
      "I don't want to get to the end of my life and find that I lived just the length of it. I want to have lived the width of it as well.",
      "As we look ahead into the next century, leaders will be those who empower others.",
      "Our greatest fear should not be of failure... but of succeeding at things in life that don't really matter.",
      "Be yourself. Everyone else is already taken.",
      "If you don't design your own life plan, chances are you'll fall into someone else's plan. And guess what they have planned for you? Not much.",
      "But you have to do what you dream of doing even while you're afraid.",
      "To be successful, you must accept all challenges that come your way. You can't just accept the ones you like.",
      "Be patient with yourself. Self-growth is tender; it's holy ground. There's no greater investment.",
      "Many of life's failures are people who did not realize how close they were to success when they gave up.",
      "If you can copy and paste one hundred and one inspirational quotes, you can do anything",
      "Sometimes I'll start a sentence and I don't even know where it's going. I just hope I find it along the way.",
      "I am Beyonce, always",
      "There's a lot of beauty in ordinary things. Isn't that kind of the point?",
      "Life is short. Drive fast and leave a sexy corpse. That's one of my mottos",
      "For a really long time that's all I had. Little moments with a girl who saw me as a friend. And a lot of people told me I was crazy to wait this long for a date with a girl who I worked with, but I think, even then I knew, I was waiting for my wife.",
      "Before I do anything I ask myself, 'Would an idiot do that?' And if the answer is yes, I do not do that thing.",
      "I love catching people in the act. That's why I always whip open doors.", "....Okay",
      "I'm so young I haven't even been born yet"
    ];

    let authorArray = [
      "Coco Chanel",
      "John Wooden",
      "Ernest Hemingway",
      "Jim Rohn",
      "Albert Einstein",
      "Swami Vivekananda",
      "Ellen DeGeneres",
      "Walt Disney",
      "Confucius",
      "Winston Churchill",
      "Warren Buffett",
      "Vaibhav Shah",
      "Dr. Seuss",
      "Denzel Washington",
      "Mae West",
      "Chris Grosser",
      "Christopher Reeve",
      "Albert Einstein",
      "Nelson Mandela",
      "Charles Darwin",
      "Helen Keller",
      "Eleanor Roosevelt",
      "Mahatma Gandhi",
      "Frank Sinatra",
      "Walt Disney",
      "Thomas Edison",
      "Malcolm Forbes",
      "David Brinkley",
      "Jonathan Swift",
      "Eleanor Roosevelt",
      "Oprah Winfrey",
      "Henry Ford",
      "Jeff Bezos",
      "Winston Churchill",
      "Coco Chanel",
      "Oscar Wilde",
      "Wayne Gretzky",
      "Bruce Feirstein",
      "Dolly Parton",
      "Richard Branson",
      "Frank Lloyd Wright",
      "Nathaniel Hawthorne",
      "Michael Jordan",
      "Albert Einstein",
      "Katie Couric",
      "Ray Goforth",
      "Neil Armstrong",
      "Arthur Ashe",
      "Mary Kay Ash",
      "Kevin Kline",
      "Mark Twain",
      "Thomas Jefferson",
      "Abraham Lincoln",
      "Robert Collier",
      "Audrey Hepburn",
      "Thomas J. Watson",
      "John Quincy Adams",
      "Michael John Bobak",
      "Oprah Winfrey",
      "Philippos",
      "Colin Powell",
      "Pablo Picasso",
      "Mark Zuckerberg",
      "Earl Nightingale",
      "Eleanor Roosevelt",
      "Vidal Sassoon",
      "John D. Rockefeller",
      "Steve Jobs",
      "Drew Houston",
      "Carl Bard",
      "Ralph Waldo Emerson",
      "Mark Twain",
      "Helen Keller",
      "Mark Caine",
      "Mother Teresa",
      "Jay-Z",
      "Bruce Lee",
      "Jimmy Spithill",
      "Katharine Hepburn",
      "Charles F. Kettering",
      "Charlotte Bronte",
      "Steve Jobs",
      "Kate Winslet",
      "Picasso",
      "Barack Obama",
      "T. Harv Eker",
      "Jim Rohn",
      "George Eliot",
      "Steve Wozniak",
      "Jane Smiley",
      "Deepak Chopra",
      "George Bernard Shaw",
      "Diane Ackerman",
      "Bill Gates",
      "Francis Chan",
      "Oscar Wilde",
      "Jim Rohn",
      "Arianna Huffington",
      "Mike Gafka",
      "Stephen Covey",
      "Thomas A. Edison",
      "Daniel Cole",
      "Michael Scott",
      "Michael Scott",
      "Pam Halpert",
      "Stanley Hudson",
      "Jim Halpert",
      "Dwight Schrute",
      "Dwight Schrute",
      "Gabriel Rosales"
    ];

    const quoteNumber = Math.floor(Math.random() * authorArray.length);

    let quoteBody = quoteArray[quoteNumber];
    let quoteAuthor = authorArray[quoteNumber];

    quote.innerHTML = "[ " + quoteBody + " ]";
    author.innerHTML = "- " + quoteAuthor;
  }
};
</script>
