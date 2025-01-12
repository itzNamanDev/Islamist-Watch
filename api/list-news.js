const fs = require('fs');
const path = require('path');

module.exports = async (req, res) => {
    try {
        const newsDirectory = path.join(__dirname, '..', 'news');  // Adjust based on where your files are located
        const files = fs.readdirSync(newsDirectory);

        const newsArticles = files.filter(file => file.endsWith('.html'))
                                   .map(file => ({
                                       href: `/news/${file}`,
                                       title: file.replace('.html', '').replace('-', ' '),  // Adjust title formatting as needed
                                       date: new Date().toLocaleDateString()
                                   }));

        res.status(200).json(newsArticles);
    } catch (error) {
        console.error(error);
        res.status(500).json({ error: 'Unable to list news articles' });
    }
};