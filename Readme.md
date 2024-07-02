# YpreyFinance

![yprey](https://i.imgur.com/NFajooG.png)

**Created by [Fernando Mengali](https://www.linkedin.com/in/fernando-mengali-273504142/)**

YpreyFinance is a framework based financial management systems. The framework perfectly simulates a finance system that can help a user in financial savings and achieving their financial objectives and goals, but it has vulnerabilities based on OWASP TOP 10 WebApp 2021. The framework was developed to teach and learn details in Pentest (testing penetration) and Application Security. In the context of Offensive Security, vulnerabilities contained in web applications can be identified, exploited and compromised. For application security professionals and experts, the framework provides an in-depth understanding of code-level vulnerabilities. Yrprey, making it valuable for educational, learning and teaching purposes in the field of Information Security. For more information about the vulnerabilities, we recommend exploring the details available at [yrprey.com](https://yrprey.com).

#### Features
 - Based on OWASP's top 10 vulnerabilities for Web Application.

Initially, a non-registered user only has access to the login.php page. The user can authenticate to the system with the credentials admin@yrprey.com and the password 1234567890. Functionalities include adding transactions, making expense comparisons by defining dates, systemic searches and removals.
yrprey finance is not recommended for personal or commercial use, only for laboratory use and learning about exploiting and patching vulnerabilities.

#### List of Vulnerabilities

In this section, we have a comparison of the vulnerabilities present in the framework with the routes and a comparison between the OWASP TOP 10 Web Application.
This table makes it easier to understand how to exploit vulnerabilities in each systemic function.
In the last two columns we have a parenthesis and the scenario associated with the OWASP TOP 10 Web Applications, facilitating the understanding of the theory described on the page https://owasp.org/www-project-top-ten/.
After understanding the scenario and the vulnerable route, the process of identifying and exploiting vulnerabilities becomes easier. If you are an Application Security professional, knowing the scenario and routes of endpoints makes the process of identifying and correcting vulnerabilities easier with manual Code Review Security techniques or automated SAST, SCA and DAST analyses

Complete table with points vulnerables, vulnerability details and a comparison between OWASP TOP 10 Web Application vulnerabilities:

|Qtde |          **OWASP TOP 10**                          |**Method**|            **Path**            |            **Details**                            |
|----:|:--------------------------------------------------:|:--------:|:------------------------------:|:-------------------------------------------------:|
| 01  |  A01:2021-Broken Access Control                    |   POST   |  /about.php?img=logo.webp      |             Path Traversal                        |
| 02  |  A01:2021-Broken Access Control                    |   POST   |  /transactions_report.php      |             View all data tarnsaction             |
| 03  |  A01:2021-Broken Access Control                    |   POST   |  /user.php                     |             View all users data                   |
| 04  |  A02:2021-Cryptographic Failures                   |   POST   |  /login.php                    |             Store password with base64            |
| 05  |  A02:2021-Cryptographic Failures                   |   POST   |  /adicionar_categoria.php      |             Credential harcoded database          |
| 06  |  A02:2021-Cryptographic Failures                   |   POST   |  /atualizar_resumo.php         |             Credential harcoded database          |
| 07  |  A02:2021-Cryptographic Failures                   |   POST   |  /atualizar_transacoes.php     |             Credential harcoded database          |
| 08  |  A02:2021-Cryptographic Failures                   |   POST   |  /delete_transaction.php       |             Credential harcoded database          |
| 09  |  A02:2021-Cryptographic Failures                   |   POST   |  /edit_transaction.php         |             Credential harcoded database          |
| 10  |  A02:2021-Cryptographic Failures                   |   POST   |  /.idea/workspace.xml          |                    File Exposure                  |
| 11  |  A02:2021-Cryptographic Failures                   |   POST   |  /htdocs/.htaccess             |                    File Exposure                  |
| 12  |  A02:2021-Cryptographic Failures                   |   POST   |  /Root                         |                    File Exposure                  |
| 13  |  A05:2021-Security Misconfiguration                |   GET    |  /phpinfo.php                  |                    File Exposure                  |
| 14  |  A05:2021-Security Misconfiguration                |   GET    |  /bkp.zip                      |                    File Exposure                  |
| 15  |  A02:2021-Cryptographic Failures                   |   POST   |  /database.php.old             |             Credential harcoded database          |
| 16  |  A02:2021-Cryptographic Failures                   |   POST   |  /database.php.txt             |             Credential harcoded database          |
| 17  |  A02:2021-Cryptographic Failures                   |   POST   |  /edit_transaction.php         |             Credential harcoded database          |
| 18  |  A03:2021-Injection                                |   POST   |  /login.php                    |        SQL Injection - Authentication             |
| 19  |  A03:2021-Injection                                |   POST   |  /login.php                    |            Cross-Site Request Forgery             |
| 20  |  A03:2021-Injection                                |   GET    |  /logout.php?url=http://...    |          Redirect to other url                    |
| 21  |  A03:2021-Injection                                |   GET    |  /transaction.php              |         Cross-Site Scripting - Stored             |
| 22  |  A03:2021-Injection                                |   GET    |  /transaction.php              |              Insert Register - CSRF               | 
| 23  |  A03:2021-Injection                                |   POST   |  /edit_transaction.php         |              Edit registers - CSRF                |
| 24  |  A03:2021-Injection                                |   POST   |  /delete_transaction.php       |            Delete registers - CSRF                |
| 25  |  A03:2021-Injection                                |   POST   |  /adicionar_categoria.php      |            Cross-Site Scripting - Stored          |
| 26  |  A03:2021-Injection                                |   POST   |  /adicionar_categoria.php      |            Adicionar Categorie - CSRF             |
| 27  |  A03:2021-Injection                                |   POST   |  /editar_categoria.php         |            Editar Categorie - CSRF                |
| 28  |  A03:2021-Injection                                |   POST   |  /delete_categoria.php         |            Delete Categorie - CSRF                |
| 29  |  A03:2021-Injection                                |   POST   |  /obter_dados_grafico.php      |            Remote Code Execution                  |
| 30  |  A03:2021-Injection                                |   POST   |  /obter_dados_grafico.php      |            Buffer Overflow (Vanilla)              |
| 31  |  A05:2021-Security Misconfiguration                |   POST   |  /login.php                    |   Intercept Credentials with Sniffer or BurpSuite |
| 32  |  A05:2021-Security Misconfiguration                |   GET    |  /ftp/WS_FTP.LOG               |            Misconfiguration                       |
| 33  |  A05:2021-Security Misconfiguration                |   GET    |  /ssh-key.priv                 |            Misconfiguration                       |
| 34  |  A05:2021-Security Misconfiguration                |   GET    |  /index.php                    |            Header - Not Definied HttpOnly         |
| 35  |  A05:2021-Security Misconfiguration                |   GET    |  /index.php                    |  Header - Not Definied Frame Options Header       |
| 36  |  A05:2021-Security Misconfiguration                |   GET    |  /index.php                    |            Header - Not Definied HSTS             |
| 37  |  A05:2021-Security Misconfiguration                |   GET    |  /index.php                    |   Header - Not Definied Content Security Policy   |
| 38  |  A05:2021-Security Misconfiguration                |   GET    |  /index.php                    |            Header - Not Definied XSS Protection   |
| 39  |  A06:2021-Vulnerable and Outdated Components       |   GET    |  /js/jquery-1.5.1.js           |  XSS to function: html,append,load,after..        |
| 40  |  A06:2021-Vulnerable and Outdated Components       |   GET    |  /js/jquery-1.5.1.js           |  Prototype Pollution to function: extend          |
| 41  |  A06:2021-Vulnerable and Outdated Components       |   GET    |  /js/lodash-3.9.0.js           |  Prototype Pollution to function: zipObjectDeep.. |
| 42  |  A06:2021-Vulnerable and Outdated Components       |   GET    |  /js/lodash-3.9.0.js           |            Code Injection across template         |
| 43  |  A06:2021-Vulnerable and Outdated Components       |   GET    |  /js/lodash-3.9.0.js           | ReDoS to functions: toNumber, trim, trimEnd       |
| 44  |  A06:2021-Vulnerable and Outdated Components       |   GET    |  /js/bootstrap-4.1.3.js        | Prototype Pollution to function: data-template... |
| 45  |  A07:2021-Identif. and Authentication Failures     |   N/A    |  Change cache cookie to admin  |  Session Hijacking (Manipulation Cookie)          |
| 46  |  A07:2021-Identif. and Authentication Failures     |   POST   |  /index.php                    |             E-mail enumeration                    |

## How Install

* 1º - Install and configure Apache, PHP and MySQL on your Linux
* 2º - Import the YRpreyPHP files to /var/www/
* 3º - Create a database named "yrprey"
* 4º - Import the yrprey.sql into the database.
* 5º - Access the address http://localhost in your browser
* 6º - In php ini change allow_url_include to "On".

## Observation
You can test on Xampp or any other platform that supports PHP and MySQL.

## Reporting Vulnerabilities

Please, avoid taking this action and requesting a CVE!

The application intentionally has some vulnerabilities, most of them are known and are treated as lessons learned. Others, in turn, are more "hidden" and can be discovered on your own. If you have a genuine desire to demonstrate your skills in finding these extra elements, we suggest you share your experience on a blog or create a video. There are certainly people interested in learning about these nuances and how you identified them. By sending us the link, we may even consider including it in our references.
