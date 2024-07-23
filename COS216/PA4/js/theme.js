function setTheme(themeName) 
{
    document.cookie = "theme=" + themeName; 
    var stylesheet = document.getElementById('theme-style');
    stylesheet.href = '../css/'+themeName + '.css';
    document.cookie = 'theme=' + themeName + '; path=/';
}