from selenium import webdriver
from selenium.webdriver.common.keys import Keys
from webdriver_manager.firefox import GeckoDriverManager


driver = webdriver.Firefox(executable_path=GeckoDriverManager().install())
driver.get("http://proj.eba-d7suzmxn.eu-central-1.elasticbeanstalk.com/view/main.php")
DBHost = driver.find_element_by_id("param[DbHost]")
DBHost.clear()
DBHost.send_keys("terraform-20210804081622768900000002.cruyyjqp2wru.eu-central-1.rds.amazonaws.com")
DBUser = driver.find_element_by_id("param[DbUser]")
DBUser.clear()
DBUser.send_keys("kek")
DBPassword = driver.find_element_by_id("param[DbPassword]")
DBPassword.send_keys("password")
driver.find_element_by_id("configButton_label").click()
driver.close()
