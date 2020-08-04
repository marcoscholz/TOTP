#TOTP

## Basics
For Time-based One-time Password algorithm two parties share some parameters at the beginning and from then on can generate the same token at any time als long as their clocks are in sync.

There are 5 parameters needed to calculate the TOTP for a given time <code><b>T</b></code>
1. The seed <code>Key</code> <i>(string)</i>
2. The starting timestamp <code>T<sub>0</sub></code> <i>(default is the unix epoch time 0)</i>
3. The interval in seconds <code>T<sub>x</sub></code> <i>(default is 30)</i>
4. The Length of token <code>N</code> <i>(default is 6)</i>
5. The hash algorith <i>(default is SHA-1)</i>

<code>TOPT = <i>function</i>(<b>T</b>, Key, T<sub>0</sub>, T<sub>x</sub>, N)</code> 

It's common to agree on some common parameters to simplify it.

- <code>T<sub>0</sub>=0</code> <i>The Unix epoch is 00:00:00 UTC on 1 January 1970</i>
- <code>T<sub>x</sub>=30</code> <i>Meaning every 30 seconds a new code is valid</i>
- <code>L=6</code> <i>The code should be 6 digits long</i>

Given one uses the defaults function reduces to <code>TOPT = <i>function</i>(<b>T</b>, Key)</code>

This repository implements a general function with the common fallback values <code>TOPT = <i>function</i>(<b>T</b>, Key, T<sub>0</sub>=0, T<sub>x</sub>=30, N=6)</code> 

## Calculation
### 1. Get the current counter
<code>C<sub>T</sub> = ( T - T <sub>0</sub>) DIV N</code> 

The generated code will get invalid at <code>T<sub>0</sub> + (N * C)</code>

 

###Resources
- https://en.wikipedia.org/wiki/Time-based_One-time_Password_algorithm
- https://tools.ietf.org/html/rfc6238
- https://rosettacode.org/wiki/Time-based_One-time_Password_Algorithm
- https://en.wikipedia.org/wiki/Base32
- https://github.com/lelag/otphp/blob/master/lib/otp.php