package br.com.sisbib.api.config.security;

import org.springframework.context.annotation.Configuration;
import org.springframework.http.HttpMethod;
import org.springframework.security.config.annotation.authentication.builders.AuthenticationManagerBuilder;
import org.springframework.security.config.annotation.web.builders.HttpSecurity;
import org.springframework.security.config.annotation.web.builders.WebSecurity;
import org.springframework.security.config.annotation.web.configuration.EnableWebSecurity;
import org.springframework.security.config.annotation.web.configuration.WebSecurityConfigurerAdapter;

@EnableWebSecurity
@Configuration
public class SecurityConfigurations extends WebSecurityConfigurerAdapter{
	
	
	//Configurações de Autenticação
	@Override
	protected void configure(AuthenticationManagerBuilder auth) throws Exception {
	}
	
	//Configurações de Autorização
	@Override
	protected void configure(HttpSecurity http) throws Exception {
		http.authorizeRequests()
			.antMatchers(HttpMethod.GET, "/livro").permitAll()
			.antMatchers(HttpMethod.GET, "/livro/*").permitAll()
			.antMatchers(HttpMethod.GET, "/agenda").permitAll()
			.antMatchers(HttpMethod.GET, "/agenda/*").permitAll()
			.antMatchers(HttpMethod.GET, "/reserva").permitAll()
			.antMatchers(HttpMethod.GET, "/reserva/*").permitAll()
			.antMatchers(HttpMethod.GET, "/usuariobb/auth").permitAll()
			.antMatchers(HttpMethod.GET, "/usuariocm/auth").permitAll()
			.antMatchers("/swagger-ui").permitAll();
	}
	
	//Configurações de recursos estáticos (JS, CSS, Imagens, etc.)
	@Override
	public void configure(WebSecurity web) throws Exception {
	}
	
}
