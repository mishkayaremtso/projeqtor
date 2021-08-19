from selenium import webdriver
from selenium.webdriver.common.keys import Keys
from webdriver_manager.firefox import GeckoDriverManager


driver = webdriver.Firefox(executable_path=GeckoDriverManager().install())
driver.get("http://kek-appservice.azurewebsites.net/view/main.php")
DBHost = driver.find_element_by_id("param[DbHost]")
DBHost.clear()
DBHost.send_keys("mysqlprojeqtor.mysql.database.azure.com")
DBUser = driver.find_element_by_id("param[DbUser]")
DBUser.clear()
DBUser.send_keys("kek")
DBPassword = driver.find_element_by_id("param[DbPassword]")
DBPassword.send_keys("HelloPassword1")
driver.find_element_by_id("configButton_label").click()
driver.close()
